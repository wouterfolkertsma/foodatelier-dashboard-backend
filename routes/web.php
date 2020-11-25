<?php

use App\Http\Controllers\CompanyController;
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
    Route::get('/manage/clients', [EmployeeController::class, 'clientsManager'])->name('client-manager');

    Route::post('/manage/new/client', [CompanyController::class, 'saveClient'])->name('client.save');
    Route::get('/manage/new/client', [CompanyController::class, 'newClient'])->name('client.new');

    Route::get('/manage/new/company', [CompanyController::class, 'newCompany'])->name('company.new');
    Route::post('/manage/new/company', [CompanyController::class, 'saveCompany'])->name('company.save');
    Route::get('/manage/{id}/company', [CompanyController::class, 'editCompany'])->name('company.edit');
    Route::post('/manage/{id}/company', [CompanyController::class, 'updateCompany'])->name('company.update');
});


Route::get('/import','ImportController@importFile');
Route::post('/import','ImportController@importExcel');