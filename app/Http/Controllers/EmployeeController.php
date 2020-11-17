<?php


namespace App\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class EmployeeController extends Controller
{
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
        return view('admin.client-management');
    }
}