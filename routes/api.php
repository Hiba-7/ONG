<?php

use App\Http\Controllers\Api\CommuneController;
use App\Http\Controllers\Api\WilayaController;
use App\Http\Controllers\Api\PaysController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('api')->group(function () {
    // pays
    Route::get('pays', [PaysController::class, 'index']);
    Route::get('pays/{id}', [PaysController::class, 'show']);
    Route::get('pays/{id}/wilayas', [PaysController::class, 'wilayas']);
    Route::get('search/pays/{q}', [PaysController::class, 'search']);

    // wilayas
    Route::get('wilayas', [WilayaController::class, 'index']);
    Route::get('wilayas/{id}', [WilayaController::class, 'show']);
    Route::get('wilayas/{id}/communes', [WilayaController::class, 'communes']);

    // communes
    Route::get('communes', [CommuneController::class, 'index']);
    Route::get('communes/{id}', [CommuneController::class, 'show']);

    // search
    Route::get('search/wilaya/{q}', [WilayaController::class, 'search']);
    Route::get('search/commune/{q}', [CommuneController::class, 'search']);
});
