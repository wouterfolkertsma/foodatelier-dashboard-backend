<?php


namespace App\Http\Controllers;


use App\Models\Dashboard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function dashboard(Request $request)
    {
        return view('client.dashboard');
    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function dashboardsManager(Request $request)
    {
        $dashboards = Dashboard::all();
        return view('admin.dashboard-management',['dashboards' => $dashboards]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $employeeId
     * @return Application|Factory|View
     */
    public function editDashboard(Request $request, int $dashboardId)
    {
        $dashboard = Dashboard::where('id', $dashboardId)
            ->firstOrFail();

        return view('admin.edit-dashboard', [
            'dashboard' => $dashboard,
        ]);
    }

}
