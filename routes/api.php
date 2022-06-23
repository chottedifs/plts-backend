<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Output\Output;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/home', [UserController::class, 'home']);
    Route::get('/tagihan', [UserController::class, 'tagihan']);
    Route::get('/detail-kios', [UserController::class, 'detailKios']);
    Route::get('/user-kios', [UserController::class, 'userKios']);
    Route::get('/detail-informasi/{id}', [UserController::class, 'detailInformasi']);
});

Route::post('/login', [AuthController::class, 'login']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     // return $request->user();
// });
