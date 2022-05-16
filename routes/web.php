<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KiosController;
use App\Http\Controllers\Admin\TarifKiosController;
use App\Http\Controllers\Admin\TarifKwhController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\InformasiController;

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
Route::resource('dashboard/master-tarifKios', TarifKiosController::class);
Route::resource('dashboard/master-tarifKwh', TarifKwhController::class);
Route::resource('dashboard/master-lokasi', LokasiController::class);
Route::resource('dashboard/master-informasi', InformasiController::class);
