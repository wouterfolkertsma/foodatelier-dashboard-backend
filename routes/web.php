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


Route::middleware(['auth'])->group(function () {
    Route::view('/', 'welcome')->name('home');
    Route::get('/manage/employees', 'EmployeeController@employeesManager')->name('employee-manager');
    Route::get('/manage/clients', 'EmployeeController@clientsManager')->name('client-manager');
    Route::get('/dashboard', 'ClientController@dashboard')->name('client-dashboard');
    Route::get('/personalinsights', 'ClientController@personalinsights')->name('client-personal-insights');
    Route::get('/socialmedia', 'ClientController@socialmedia')->name('client-social-media');
    Route::get('/trends', 'ClientController@trends')->name('client-trends');
    Route::get('/newsfeed', 'ClientController@newsfeed')->name('client-newsfeed');
});

Route::get('/import','ImportController@importFile');
Route::post('/import','ImportController@importExcel');
