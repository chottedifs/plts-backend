<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KiosController;
use App\Http\Controllers\Admin\TarifKiosController;

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
    return view('pages.admin.dashboard', [
        'judul' => 'Dashboard'
    ]);
});

// ADMIN
Route::resource('dashboard/master-kios', KiosController::class);
Route::resource('dashboard/tarifKios', TarifKiosController::class);