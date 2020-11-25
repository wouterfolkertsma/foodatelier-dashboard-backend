<?php


namespace App\Http\Controllers;


use App\Http\Repositories\ClientRepository;
use App\Http\Repositories\CompanyRepository;
use App\Http\Repositories\EmployeeRepository;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\StoreUser;
use App\Models\Company;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Throwable;

class CompanyController extends Controller
{
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
        ClientRepository $clientRepository
    ) {
        $this->employeesRepository = $employeeRepository;
        $this->companyRepository = $companyRepository;
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function newClient(Request $request)
    {
        return view('admin.new-client');
    }

    /**
     * @param StoreUser $request
     * @return void
     * @throws Throwable
     */
    public function saveClient(StoreUser $request)
    {
        try {
            $success = $this->clientRepository->save($request->all());
        } catch (Exception $exception) {
            dd($exception);
        }

        if ($success) {
            redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function newCompany(Request $request)
    {
        return view('admin.new-company');
    }

    /**
     * @param StoreCompany $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function saveCompany(StoreCompany $request)
    {
        try {
            $success = $this->companyRepository->save($request->all());
        } catch (Exception $exception) {
            dd($exception);
        }

        if ($success) {
            $company = Company::where('name', $request->input('name'))->firstOrFail();

            return redirect()->route('company.edit', ['id' => $company->id]);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Application|Factory|View
     * @throws Throwable
     */
    public function updateCompany(Request $request, int $id)
    {
        try {
            /** @var Company $company */
            $company = Company::findOrFail($id);
        } catch (Exception $exception) {
            abort(404);
        }

        $this->companyRepository->save($request->all(), $company);

        /** @var User[] $users */
        $users = $this->companyRepository->getUsers($company);

        return view('admin.edit-company', [
            'users' => $users,
            'company' => $company
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Application|Factory|View
     */
    public function editCompany(Request $request, int $id)
    {
        try {
            /** @var Company $company */
            $company = Company::findOrFail($id);
        } catch (Exception $exception) {
            abort(404);
        }

        /** @var User[] $users */
        $users = $this->companyRepository->getUsers($company);

        return view('admin.edit-company', [
            'users' => $users,
            'company' => $company
        ]);
    }
}