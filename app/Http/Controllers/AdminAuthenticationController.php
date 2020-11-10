<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthenticationController extends Controller
{
    public function login(Request $request)
    {
        dd($request);
    }

    public function index(Request $request)
    {
        return view('login', [
            'postAction' => 'AdminAuthenticationController@login'
        ]);
    }
}
