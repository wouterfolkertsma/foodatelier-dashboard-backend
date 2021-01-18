<?php


namespace App\Http\Controllers;


use App\Models\Data\Data;
use App\Models\Data\File;
use App\Models\Data\RssFeed;
use App\Models\Data\TrendFilter;
use App\Traits\HasDashboard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ClientController extends Controller
{
    use HasDashboard;

    public function getMenuCategories(Request $request){

        $dashboardId = $this->getDashboard()->id;

        $targetDataType = 'App\Models\Data\RssFeed';

        $rss = DB::table('dashboard_data')->select('dashboard_id', 'data_id')
            ->where('dashboard_data.dashboard_id', '=', $dashboardId)
            ->join ('data', 'data.id', '=', 'dashboard_data.data_id')
            ->where('data_type', '=', $targetDataType)
            ->join ('rss_feeds', 'rss_feeds.id', '=', 'data.data_id')
            ->join ('categories', 'categories.id', '=', 'rss_feeds.category_id')
            ->select('categories.id', 'categories.name')
            ->distinct()
            ->get();

        $targetDataType = 'App\Models\Data\TrendFilter';

        $filters = DB::table('dashboard_data')->select('dashboard_id', 'data_id')
            ->where('dashboard_data.dashboard_id', '=', $dashboardId)
            ->join ('data', 'data.id', '=', 'dashboard_data.data_id')
            ->where('data_type', '=', $targetDataType)
            ->join ('trend_filters', 'trend_filters.id', '=', 'data.data_id')
            ->join ('categories', 'categories.id', '=', 'trend_filters.category_id')
            ->select('categories.id', 'categories.name')
            ->distinct()
            ->get();

        $targetDataType = 'App\Models\Data\File';

        $files = DB::table('dashboard_data')->select('dashboard_id', 'data_id')
            ->where('dashboard_data.dashboard_id', '=', $dashboardId)
            ->join ('data', 'data.id', '=', 'dashboard_data.data_id')
            ->where('data_type', '=', $targetDataType)
            ->join ('files', 'files.id', '=', 'data.data_id')
            ->join ('categories', 'categories.id', '=', 'files.category_id')
            ->select('categories.id', 'categories.name')
            ->distinct()
            ->get();


        return response(['rss' => $rss, 'filters' =>$filters, 'files' =>$files]);
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
     * @return Application|Factory|View
     */
    public function files(Request $request)
    {
        $files = $this->getDashboard()->data->filter(function ($data) {
            return $data->data_type === File::class;
        });

        return view('client.files', [
            'files' => $files
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function newsFeed(Request $request)
    {
        return view('client.newsfeed');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function socialMedia(Request $request)
    {
        return view('client.social-media');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function personalInsights(Request $request)
    {
        return view('client.personal-insights');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function trends(Request $request)
    {
        $filters = $this->getDashboard()->data->filter(function ($data) {
            return $data->data_type === TrendFilter::class;
        });


        foreach ($filters as $filter) {
            $test = $filter->load('data');

            //dd(unserialize($filter->data->search_term));
            $filter->data->search_term = unserialize($filter->data->search_term);
        }


        return view('client.trends', [
            'filters' => $filters
        ]);
    }
}
