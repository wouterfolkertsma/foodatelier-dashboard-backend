<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\TrendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RssFeedController;
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

    Route::get('/menu/employees/load-menu-categories', [EmployeeController::class, 'getMenuCategories'])->name('employee.get-menu-categories');

    Route::get('/manage/employees', 'EmployeeController@employeesManager')->name('employee-manager');
    Route::get('/manage/clients', [EmployeeController::class, 'clientsManager'])->name('client-manager');

    Route::get('/manage/new/company', [CompanyController::class, 'newCompany'])->name('company.new');
    Route::post('/manage/new/company', [CompanyController::class, 'saveCompany'])->name('company.save');

    Route::get('/manage/dashboards', 'DashboardController@dashboardsManager')->name('dashboard-manager');
    Route::get('/manage/{id}/dashboards', [DashboardController::class, 'editDashboard'])->name('dashboard.edit');
    Route::post('/manage/{dashboard}/dashboards', [DashboardController::class, 'updateDashboard'])->name('dashboard.update');
    Route::get('/manage/{dashboard}/dashboards/{data}/add', [DashboardController::class, 'addDataToDashboard'])->name('dashboard.data.add');
    Route::get('/manage/{dashboard}/dashboards/{data}/remove', [DashboardController::class, 'removeDataFromDashboard'])->name('dashboard.data.remove');

//    Route::get('/manage/dashboards/{data}/edit', [DashboardController::class, 'addToDashboard'])->name('dashboard.add');
//    Route::post('/manage/dashboards/{data}/edit', [DashboardController::class, 'saveToDashboard'])->name('dashboard.add.save');

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
    Route::get('/menu/client/load-menu-categories', [ClientController::class, 'getMenuCategories'])->name('client.get-menu-categories');

    Route::get('/files', [ClientController::class, 'files'])->name('client-files');

    Route::get('/manage/files', [EmployeeController::class, 'fileManager'])->name('file-manager');
    Route::get('/manage/{id}/files', [EmployeeController::class, 'categoryFileManager'])->name('file.category-manager');
    Route::post('/manage/files/upload', [DataController::class, 'fileUpload'])->name('file-upload');
    Route::get('/manage/files/delete', [DataController::class, 'fileDelete'])->name('file.delete');

    Route::get('/manage/rss', [RssFeedController::class, 'index'])->name('rss.index');
    Route::get('/manage/{id}/rss', [RssFeedController::class, 'categoryIndex'])->name('rss.category-index');
    Route::get('/manage/rss/{rssFeed}/edit', [RssFeedController::class, 'edit'])->name('rss.edit');
    Route::post('/manage/rss/{rssFeed}/update', [RssFeedController::class, 'updateRssFeed'])->name('rss.update');
    Route::get('/manage/rss/{rssFeed}/delete', [RssFeedController::class, 'delete'])->name('rss.delete');
    Route::get('/manage/rss/new', [RssFeedController::class, 'new'])->name('rss.new');
    Route::post('/manage/rss/new', [RssFeedController::class, 'saveNewRssFeed'])->name('rss.save');
    Route::get('/manage/rss/preview', [RssFeedController::class, 'preview'])->name('rss.preview');
    Route::get('/manage/rss/{rssFeed}/preview', [RssFeedController::class, 'previewExisting'])->name('rss.preview.existing');

    Route::get('/manage/categories', [CategoryController::class, 'categoryManager'])->name('category-manager');
    Route::get('/manage/new-categories', [CategoryController::class, 'newCategory'])->name('category.new');
    Route::post('/manage/add-category', [CategoryController::class, 'saveCategory'])->name('category.save');
    Route::get('/manage/{id}/category', [CategoryController::class, 'editCategory'])->name('category.edit');

    Route::get('/manage/trends', [TrendController::class, 'trendsManager'])->name('trends-manager');
    Route::get('/manage/{id}/trends', [TrendController::class, 'categoryTrendsManager'])->name('category.trends-manager');

    Route::get('/manage/trends/filter', [TrendController::class, 'newFilter'])->name('filter.new');
    Route::post('/manage/trends/add-filter', [TrendController::class, 'saveFilter'])->name('filter.save');
    Route::get('/manage/trends/{id}/filter', [TrendController::class, 'editFilter'])->name('filter.edit');
    Route::get('/manage/trends/load-filter', [TrendController::class, 'getTrendGraph'])->name('filter.get-saved-trend-graph');
    Route::get('/manage/trends/filter/getTrendGraph', [TrendController::class, 'getTrendGraphPreview'])->name('filter.get-trend-graph');
    Route::get('/manage/trends/filter/getRelatedTerms', [TrendController::class, 'getRelatedTermsPreview'])->name('filter.get-related-terms');
    Route::post('/manage/trends/{id}/filter', [TrendController::class, 'updateFilter'])->name('filter.update');

    Route::get('/messenger', [MessengerController::class, 'messengerInbox'])->name('messenger-inbox');
    Route::get('/messenger/{id}', [MessengerController::class, 'messengerMessage'])->name('messenger-message');
    Route::post('/message', [MessengerController::class, 'sendMessage'])->name('send-message');
});
