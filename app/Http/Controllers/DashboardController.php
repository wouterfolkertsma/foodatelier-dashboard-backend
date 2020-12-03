<?php


namespace App\Http\Controllers;


use App\Models\Dashboard;
use App\Models\Data\Data;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Stmt\DeclareDeclare;
use Psy\Util\Json;

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
     */
    public function updateDashboard(Request $request)
    {
        dd($request);
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
     * @param Request $request
     * @param Dashboard $dashboard
     * @param Data $data
     * @return JsonResponse
     */
    public function addDataToDashboard(Request $request, Dashboard $dashboard, Data $data)
    {
        try {
            $dashboard->data->push($data);
            $dashboard->data()->sync($dashboard->data);

            return new JsonResponse([
                'success' => 'true',
                'data' => $data->load('data')->toArray()
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'success' => 'false',
                'data' => 'Something went wrong'
            ]);
        }
    }

    /**
     * @param Request $request
     * @param Dashboard $dashboard
     * @param Data $data
     * @return JsonResponse
     */
    public function removeDataFromDashboard(Request $request, Dashboard $dashboard, Data $data)
    {
        try {
            if ($dashboard->data->contains($data)) {
                $dashboard->data->pull($data->id);
                $dashboard->data()->sync($dashboard->data);
            }

            return new JsonResponse([
                'success' => 'true',
                'data' => $data->load('data')->toArray()
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'success' => 'false',
                'data' => 'Something went wrong'
            ]);
        }
    }

    /**
     * @param Request $request
     * @param int $dashboardId
     * @return Application|Factory|View
     */
    public function editDashboard(Request $request, int $dashboardId)
    {
        $dashboard = Dashboard::where('id', $dashboardId)
            ->firstOrFail();

        $data = collect($dashboard->data);
        $allData = Data::all();

        $allData = $allData->filter(function ($item) use ($data) {
           return !$data->pluck('id')->contains($item->id);
        });

        return view('admin.edit-dashboard', [
            'dashboard' => $dashboard,
            'data' => $allData
        ]);
    }

}
