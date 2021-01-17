<?php


namespace App\Http\Controllers;

use App\Http\Repositories\DashboardRepository;
use App\Models\Dashboard;
use App\Models\Data\Data;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class DashboardController extends Controller
{
    /** @var DashboardRepository */
    private $dashboardRepository;

    /**
     * DashboardController constructor.
     *
     * @param DashboardRepository $dashboardRepository
     */
    public function __construct(
        DashboardRepository $dashboardRepository
    ) {
        $this->dashboardRepository = $dashboardRepository;
    }

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
     * @param Dashboard $dashboard
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateDashboard(Request $request, Dashboard $dashboard): RedirectResponse
    {
        try {
            $this->dashboardRepository->save($request->all(), $dashboard);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->back()->with('success', 'Dashboard geupdate');
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
        } catch (Exception $exception) {
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
    public function removeDataFromDashboard(Request $request, Dashboard $dashboard, Data $data): JsonResponse
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
        } catch (Exception $exception) {
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
