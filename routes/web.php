<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\Setting\LogActivityController;
use App\Http\Controllers\Admin\Setting\RoleUserController;
use App\Http\Controllers\Admin\Setting\UserController;
use App\Http\Controllers\ErrorPageController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified','active',
    ])->prefix('dashboard')->group(function () {

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    //Setting
        //Log Activity
        Route::get('/setting/log-activity', [LogActivityController::class, 'index'])->name('log-activity.index');
        Route::get('/setting/log-activity/{id}', [LogActivityController::class, 'show'])->name('log-activity.show');
        //Role User
        Route::resource('/setting/role-user', RoleUserController::class);
        //User
        Route::resource('/setting/user', UserController::class);

    //Report
        //Users PDF
        Route::get('/report/user', [ReportController::class, 'user'])->name('report.user');

    //Datatables
        //Settings
        Route::get('/setting/log-activity-data', [DataController::class, 'log'])->name('data.log-activity');
        Route::get('/setting/role-user-data', [DataController::class, 'roleuser'])->name('data.role-user');
        Route::get('/setting/user-data', [DataController::class, 'user'])->name('data.user');

    //Photo
        //Delete
        Route::put('/photo/delete-user-profile/{id}', [PhotoController::class, 'deleteuser'])->name('delete-photo-user');

});

//Error
Route::get('/user-disabled', [ErrorPageController::class, 'active'])->name('error.active');
