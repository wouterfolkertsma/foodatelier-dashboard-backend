<?php


namespace App\Http\Controllers;


use App\Models\Data\Data;
use App\Models\Data\File;
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
        return view('client.trends');
    }
}
