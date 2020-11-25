<?php


namespace App\Http\Controllers;


use App\Http\Repositories\ClientRepository;
use App\Http\Repositories\CompanyRepository;
use App\Http\Repositories\EmployeeRepository;
use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class EmployeeController extends Controller
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
    public function employeesManager(Request $request)
    {
        return view('admin.employee-management');
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
}