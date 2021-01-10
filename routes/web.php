<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
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

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::view('/', 'welcome')->name('home');

    Route::get('/manage/{user}/user', [UserController::class, 'editUser'])->name('user.edit');
    Route::get('/manage/{user}/user/settings', [UserController::class, 'editUserSettings'])->name('user.editSettings');
//    Route::post('user', 'UserController@updateAvatar')->middleware('auth')->name('user.updateAvatar');
    Route::post('/manage/{user}/user/upload', [UserController::class, 'updateAvatar'])->name('user.updateAvatar');
    Route::post('/manage/{user}/user/changecontact', [UserController::class, 'updateContact'])->name('user.updateContact');
    Route::post('/manage/{user}/user/changeName', [UserController::class, 'updateName'])->name('user.updateName');
    Route::post('/manage/{user}/user/changedesc', [UserController::class, 'updateDesc'])->name('user.updateDesc');

    Route::get('/manage/employees', 'EmployeeController@employeesManager')->name('employee-manager');
    Route::get('/manage/clients', [EmployeeController::class, 'clientsManager'])->name('client-manager');

    Route::get('/manage/new/company', [CompanyController::class, 'newCompany'])->name('company.new');
    Route::post('/manage/new/company', [CompanyController::class, 'saveCompany'])->name('company.save');

    Route::get('/manage/dashboards', 'DashboardController@dashboardsManager')->name('dashboard-manager');
    Route::get('/manage/{id}/dashboards', [DashboardController::class, 'editDashboard'])->name('dashboard.edit');

    Route::get('/manage/{id}/company', [CompanyController::class, 'editCompany'])->name('company.edit');
    Route::post('/manage/{id}/company', [CompanyController::class, 'updateCompany'])->name('company.update');

    Route::post('/manage/{id}/company/add-client', [CompanyController::class, 'saveClient'])->name('client.save');
    Route::get('/manage/{id}/company/add-client', [CompanyController::class, 'newClient'])->name('client.new');

    Route::get('/manage/{id}/client', [CompanyController::class, 'editClient'])->name('client.edit');
    Route::post('/manage/{id}/client', [CompanyController::class, 'updateClient'])->name('client.update');
    Route::get('/manage/{id}/client/delete', [CompanyController::class, 'deleteClient'])->name('client.delete');

    Route::post('/manage/add-employee', [EmployeeController::class, 'saveEmployee'])->name('employee.save');
    Route::get('/manage/add-employee', [EmployeeController::class, 'newEmployee'])->name('employee.new');

    Route::get('/manage/{id}/employee', [EmployeeController::class, 'editEmployee'])->name('employee.edit');
    Route::post('/manage/{id}/employee', [EmployeeController::class, 'updateEmployee'])->name('employee.update');
    Route::get('/manage/{id}/employee/delete', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete');

    Route::get('/dashboard', 'ClientController@dashboard')->name('client-dashboard');
    Route::get('/personalinsights', 'ClientController@personalinsights')->name('client-personal-insights');
    Route::get('/socialmedia', 'ClientController@socialmedia')->name('client-social-media');
    Route::get('/trends', 'ClientController@trends')->name('client-trends');
    Route::get('/newsfeed', 'ClientController@newsfeed')->name('client-newsfeed');

    Route::get('/files', [ClientController::class, 'files'])->name('client-files');
});


Route::get('/import','ImportController@importFile');
Route::post('/import','ImportController@importExcel');
