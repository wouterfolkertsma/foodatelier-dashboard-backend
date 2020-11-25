<?php

use App\Http\Controllers\EmployeeController;
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
Route::view('/', 'welcome')->name('home');

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/manage/employees', 'EmployeeController@employeesManager')->name('employee-manager');
    Route::get('/manage/clients', 'EmployeeController@clientsManager')->name('client-manager');
    Route::get('/manage/{id}/company', [EmployeeController::class, 'editCompany'])->name('edit-company');
});

Route::get('/import','ImportController@importFile');
Route::post('/import','ImportController@importExcel');