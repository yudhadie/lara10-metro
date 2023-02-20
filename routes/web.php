<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\Setting\UserController;
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
    'verified'
    ])->prefix('dashboard')->group(function () {

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //Setting
        //User
        Route::resource('/setting/user', UserController::class);

    //Datatables
        //Settings
        Route::get('/setting/user-data', [DataController::class, 'user'])->name('data.user');

    //Photo
        //Delete
        Route::put('/photo/delete-user-profile/{id}', [PhotoController::class, 'deleteuser'])->name('delete-photo-user');

});
