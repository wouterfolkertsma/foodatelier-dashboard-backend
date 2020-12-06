<?php


namespace App\Http\Controllers;


use App\Http\Repositories\ClientRepository;
use App\Http\Repositories\CompanyRepository;
use App\Http\Repositories\EmployeeRepository;
use App\Http\Requests\StoreClient;
use App\Http\Requests\StoreCompany;
use App\Models\Client;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Throwable;

class CompanyController extends Controller
{
    const ROLE_CLIENT = 'Client';

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

    /**
     * @param Request $request
     * @param int $clientId
     * @return Application|Factory|View
     */
    public function editClient(Request $request, int $clientId)
    {
        $client = Client::where('id', $clientId)
            ->with('user')
            ->firstOrFail();

        return view('admin.edit-client', [
            'client' => $client,
        ]);
    }

    /**
     * @param Request $request
     * @param int $clientId
     * @return RedirectResponse
     * @throws Throwable
     */
    public function deleteClient(
        Request $request,
        int $clientId
    ) {
        $client = Client::where('id', $clientId)
            ->with('user', 'company')
            ->firstOrFail();

        $companyId = $client->company->id;

        try {
            $this->clientRepository->delete($client);
        } catch (Exception $exception) {
            redirect()->back()->with('error', 'Something went wrong');
            dd($exception);

        }

        return redirect()->route('company.edit', ['id' => $companyId])->with('success', 'Client-Account deleted');
    }

    /**
     * @param Request $request
     * @param int $clientId
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateClient(Request $request, int $clientId)
    {
        $client = Client::where('id', $clientId)
            ->with('user')
            ->firstOrFail();

        $this->clientRepository->save($request->all(), $client);
        return redirect()->route('client.edit', ['id' => $client->id])->with('success', 'Client-Account updated');
    }

    /**
     * @param Request $request
     * @param int $companyId
     * @return Application|Factory|View
     */
    public function newClient(Request $request, int $companyId)
    {
        $role = Role::where('name', self::ROLE_CLIENT)->firstOrFail();

        return view('admin.new-client', [
            'role' => $role,
            'companyId' => $companyId
        ])->with('success', 'Client-Account created');;
    }

    /**
     * @param StoreClient $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function saveClient(StoreClient $request)
    {
        try {
            $success = $this->clientRepository->save($request->all());
        } catch (Exception $exception) {
            redirect()->back()->with('error', 'Something went wrong');
            dd($exception);
        }

        if ($success) {
            $this->passwordResetLinkController->store($request);

            return redirect()->route('company.edit', ['id' => $request->input('company_id')])->with('success', 'Client-Account created');
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
            $successDashboard = $this->companyRepository->createDashboard($company);

            if ($successDashboard) {
                return redirect()->route('company.edit', ['id' => $company->id])->with('success', 'Client created');
            }
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
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

        return redirect()->route('company.edit', ['id' => $company->id])->with('success', 'Client updated');
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
