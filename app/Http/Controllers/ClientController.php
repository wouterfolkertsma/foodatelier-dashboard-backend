<?php


namespace App\Http\Controllers;


use App\Models\Data\Data;
use App\Models\Data\File;
use App\Models\Data\TrendFilter;
use App\Traits\HasDashboard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class ClientController extends Controller
{
    use HasDashboard;

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
