<?php


namespace App\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class ClientController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function dashboard(Request $request)
    {
        return view('client.dashboard');
    }
    public function newsfeed(Request $request)
    {
        return view('client.newsfeed');
    }
    public function socialmedia(Request $request)
    {
        return view('client.social-media');
    }
    public function personalinsights(Request $request)
    {
        return view('client.personal-insights');
    }
    public function trends(Request $request)
    {
        return view('client.trends');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */

}
