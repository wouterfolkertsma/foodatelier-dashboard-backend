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

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function newsfeed(Request $request)
    {
        return view('client.newsfeed');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function socialmedia(Request $request)
    {
        return view('client.social-media');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function personalinsights(Request $request)
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