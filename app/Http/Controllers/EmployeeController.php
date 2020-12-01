<?php


namespace App\Http\Controllers;


use App\Http\Repositories\ClientRepository;
use App\Http\Repositories\CompanyRepository;
use App\Http\Repositories\EmployeeRepository;
use App\Http\Requests\StoreEmployee;
use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

class EmployeeController extends Controller
{
    const ROLE_EMPLOYEE = 'Admin';


    /** @var EmployeeRepository */
    private $employeesRepository;

    /** @var ClientRepository */
    private $clientRepository;

    /** @var CompanyRepository */
    private $companyRepository;

    /**
     * EmployeeController constructor.
     *
     * @param EmployeeRepository $employeeRepository
     * @param CompanyRepository $companyRepository
     * @param ClientRepository $clientRepository
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
     * @param \Illuminate\Http\Request $request
     * @param int $companyId
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
     * @param \Illuminate\Http\Request $request
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
            dd($exception);
        }

        return redirect()->route('employee-manager');
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
     * @return Application|Factory|View
     * @throws Throwable
     */
    public function updateEmployee(\Illuminate\Http\Request $request, int $employeeId)
    {
        $employee = Employee::where('id', $employeeId)
            ->with('user')
            ->firstOrFail();

        $this->employeesRepository->save($request->all(), $employee);
        $request->session()->flash('alert-success', 'Employee was successful updated!');
        return view('admin.edit-employee', [
            'employee' => $employee,
        ]);
    }

    /**
     * @param StoreClient $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function saveEmployee(StoreEmployee $request)
    {
        try {
            $success = $this->employeesRepository->save($request->all());
        } catch (Exception $exception) {
            dd($exception);
        }

        if ($success) {
            $this->passwordResetLinkController->store($request);

            return redirect()->route('employee-manager');
        }
    }

}
