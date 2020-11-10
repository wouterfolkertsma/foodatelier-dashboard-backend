<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login','AuthenticationController@index');
Route::post('login','AuthenticationController@login');

Route::get('backend','AdminAuthenticationController@index');
Route::post('backend','AdminAuthenticationController@login');

Route::get('/import','ImportController@importFile');
Route::post('/import','ImportController@importExcel');