<?php

use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\Setting\ContentCategoryController;
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

    //Content
    Route::resource('/content', ContentController::class);
    Route::get('/content-data', [ContentController::class, 'data'])->name('content.data');

    //Setting
        //Activity
        Route::get('/setting/log-activity', [LogActivityController::class, 'index'])->name('log-activity.index');
        Route::get('/setting/log-activity/{id}', [LogActivityController::class, 'show'])->name('log-activity.show');
        Route::get('/setting/log-activity-data', [LogActivityController::class, 'data'])->name('log-activity.data');
        //Content Category
        Route::resource('/setting/content-category', ContentCategoryController::class);
        Route::get('/setting/content-category-data', [ContentCategoryController::class, 'data'])->name('content-category.data');
        //Role User
        Route::resource('/setting/role-user', RoleUserController::class);
        Route::get('/setting/role-user-data', [RoleUserController::class, 'data'])->name('role-user.data');
        //User
        Route::resource('/setting/user', UserController::class);
        Route::get('/setting/user-data', [UserController::class, 'data'])->name('user.data');

    //Report
        //Users PDF
        Route::get('/report/user', [ReportController::class, 'user'])->name('report.user');

    //Photo
        //Delete
        Route::put('/photo/delete-user-profile/{id}', [PhotoController::class, 'deleteuser'])->name('delete-photo-user');

});

//Error
Route::get('/user-disabled', [ErrorPageController::class, 'active'])->name('error.active');
