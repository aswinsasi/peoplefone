<?php

use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Admin Authentication Routes
Route::group(['middleware' => 'web'], function () {
    // Admin login routes
    Route::get('/admin/login', 'App\Http\Controllers\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/admin/login', 'App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/admin/logout', 'App\Http\Controllers\Auth\AdminLoginController@logout')->name('admin.logout');
});

//Admin Dashboard Route
Route::group(['middleware' => ['web', 'admin']], function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

     // User management routes
     Route::get('/admin/user-management', 'App\Http\Controllers\Admin\UserManagementController@index')->name('admin.user-management');
     Route::post('/admin/impersonate/{user}', 'App\Http\Controllers\Admin\ImpersonateController@impersonate')->name('admin.impersonate');
     Route::get('/admin/impersonate/{user}', 'App\Http\Controllers\Admin\ImpersonateController@impersonate')->name('admin.impersonate');
     Route::post('/admin/stop-impersonating', 'App\Http\Controllers\Admin\ImpersonateController@stopImpersonating')->name('admin.stop-impersonating');

     // Route for creating notifications
    Route::get('/notifications/create', [NotificationController::class, 'create'])
    ->name('admin.create-notification');
    Route::post('/notifications/send', [NotificationController::class, 'sendNotification'])
    ->name('notifications.send');
    Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');
    Route::put('/notifications/{notification}', [NotificationController::class, 'update'])
    ->name('notifications.update');

    Route::put('/users/{userId}', [UserController::class, 'update'])
    ->name('users.update');
});
