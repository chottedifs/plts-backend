<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminController;
use App\Http\Controllers\Admin\DashboardOutletController;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Operator\DashboardController as OperatorController;
use App\Http\Controllers\User\DashboardController as UserController;

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
    
    // Admin Dashboard
    Route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')->middleware('checkRole:admin')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        // Route::resource('outlet', 'DashboardOutletController');
        // Route::get('outlet', [OutletController::class, 'index'])->name('outlet');
        // Route::get('outlet', [DashboardOutletController::class, 'index'])->name('outlet');
    });

    // Operator Dashboard
    Route::prefix('operator/dashboard')->namespace('Operator')->name('operator.')->middleware('checkRole:operator')->group(function(){
        Route::get('/', [OperatorController::class, 'index'])->name('dashboard');
        
    });

    Route::resource('/admin/dashboard/outlet', DashboardOutletController::class);
    Route::resource('/admin/dashboard/rate', RateController::class);
});


require __DIR__.'/auth.php';
