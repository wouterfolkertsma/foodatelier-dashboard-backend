<?php


namespace App\Http\Controllers;


use App\Http\Repositories\ClientRepository;
use App\Http\Repositories\CompanyRepository;
use App\Http\Repositories\EmployeeRepository;
use App\Http\Requests\StoreEmployee;
use App\Models\Category;
use App\Models\Company;
use App\Models\Dashboard;
use App\Models\Data\File;
use App\Models\Data\RssFeed;
use App\Models\Employee;
use App\Models\Role;
use http\Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Throwable;

class EmployeeController extends Controller
{
    const ROLE_EMPLOYEE = 'Admin';


    /** @var EmployeeRepository */
    private $employeesRepository;

    /** @var ClientRepository */
    private $clientRepository;

    /** @var CompanyRepository */
    private $companyRepository;

    /**  @var PasswordResetLinkController */
    private $passwordResetLinkController;

    /**
     * EmployeeController constructor.
     *
     * @param EmployeeRepository $employeeRepository
     * @param CompanyRepository $companyRepository
     * @param ClientRepository $clientRepository
     * @param PasswordResetLinkController $passwordResetLinkController
     */
    public function __construct(
        EmployeeRepository $employeeRepository,
        CompanyRepository $companyRepository,
        ClientRepository $clientRepository,
        PasswordResetLinkController $passwordResetLinkController
    ) {
        $this->employeesRepository = $employeeRepository;
        $this->companyRepository = $companyRepository;
        $this->clientRepository = $clientRepository;
        $this->passwordResetLinkController = $passwordResetLinkController;
    }

    public function getMenuCategories(Request $request){


        $rss = DB::table('rss_feeds')->select('category_id')
            ->distinct()
            ->join('categories', 'categories.id', '=', 'category_id')
            ->select('categories.id', 'categories.name')
            ->get();
        $filters = DB::table('trend_filters')->select('category_id')
            ->distinct()
            ->join('categories', 'categories.id', '=', 'category_id')
            ->select('categories.id', 'categories.name')
            ->get();
        $files = DB::table('files')->select('category_id')
            ->distinct()
            ->join('categories', 'categories.id', '=', 'category_id')
            ->select('categories.id', 'categories.name')
            ->get();
        return response(['rss' => $rss, 'filters' =>$filters, 'files' =>$files]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function fileManager(Request $request)
    {
        $allData = File::all();
        $categories = Category::pluck( 'name', 'id');
        $dashboards = Dashboard::pluck( 'name', 'id');

        return view('admin.file-management', [
            'data' => $allData,
            'categories' => $categories,
            'dashboards' => $dashboards
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function categoryFileManager(Request $request, $categoryId)
    {
        $allData = File::where('category_id', $categoryId)
            ->get();
        $dashboards = Dashboard::pluck( 'name', 'id');

        return view('admin.file-management', [
            'data' => $allData,
            'dashboards' => $dashboards
        ]);
    }



    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function employeesManager(Request $request)
    {
        $employees = Employee::all();

        return view('admin.employee-management',['employees' => $employees]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function clientsManager(Request $request)
    {
        $companies = Company::all();

        return view('admin.client-management', ['companies' => $companies]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function newEmployee(Request $request)
    {
        $role = Role::where('name', self::ROLE_EMPLOYEE)->firstOrFail();

        return view('admin.new-employee', [
            'role' => $role
        ]);
    }

    /**
     * @param Request $request
     * @param int $employeeId
     * @return RedirectResponse
     * @throws Throwable
     */
    public function deleteEmployee(
        Request $request,
        int $employeeId
    ) {
        $employee = Employee::where('id', $employeeId)
            ->with('user')
            ->firstOrFail();

        try {
            $this->employeesRepository->delete($employee);
        } catch (Exception $exception) {
            redirect()->back()->with('error', 'Something went wrong');
            dd($exception);
        }

        return redirect()->route('employee-manager')->with('success', 'Employee-Account deleted');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $employeeId
     * @return Application|Factory|View
     */
    public function editEmployee(Request $request, int $employeeId)
    {
        $employee = Employee::where('id', $employeeId)
            ->with('user')
            ->firstOrFail();

        return view('admin.edit-employee', [
            'employee' => $employee,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $employeeId
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateEmployee(\Illuminate\Http\Request $request, int $employeeId)
    {
        $employee = Employee::where('id', $employeeId)
            ->with('user')
            ->firstOrFail();


        $this->employeesRepository->save($request->all(), $employee);

        return redirect()->route('employee.edit', ['id' => $employee->id])->with('success', 'Employee-Account updated');
    }

    /**
     * @param StoreEmployee $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function saveEmployee(StoreEmployee $request)
    {
        try {
            $success = $this->employeesRepository->save($request->all());
        } catch (Exception $exception) {
            redirect()->back()->with('error', 'Something went wrong');
        }

        if ($success) {
            $this->passwordResetLinkController->store($request);

            return redirect()->route('employee-manager')->with('success', 'Employee-Account created');
        }
    }

}
