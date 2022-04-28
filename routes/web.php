<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminController;
use App\Http\Controllers\Admin\DashboardOutletController;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\TagihanController;
// use App\Http\Controllers\Operator\DashboardController as OperatorController;
use App\Http\Controllers\Admin\UserController;

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


// Middleware Group
Route::middleware(['auth'])->group(function () {
    // Dashboard Routes
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['checkRole:admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin-dashboard');
        Route::resource('dashboard/outlet', DashboardOutletController::class);
        Route::resource('dashboard/rate', RateController::class);
        Route::resource('dashboard/tagihan', TagihanController::class);
        Route::resource('dashboard/user', UserController::class);
        // Action Status Kios
        Route::post('status-available/{outlet}', [DashboardOutletController::class, 'setStatusAvailable'])->name('status-available');
        Route::post('status-notAvailable/{outlet}', [DashboardOutletController::class, 'setStatusNotAvailable'])->name('status-notAvailable');
    });

});


require __DIR__.'/auth.php';
