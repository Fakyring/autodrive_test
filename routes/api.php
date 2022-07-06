<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SalonController;

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

//SQL Tasks
Route::get('salon/city-salon-name', [ApiController::class, 'getSalonCity']);
Route::get('salon/stock-stats', [ApiController::class, 'getSalonCars']);
Route::get('salon/stock-price', [ApiController::class, 'getSalonMaxPrice']);
Route::get('model/color-stats', [ApiController::class, 'getModelColorCount']);
Route::get('salon/stock-stats-order', [ApiController::class, 'getSalonOrdered']);

//Salons CRUD
Route::get('salon/{id}', [SalonController::class, 'readSalon']);
Route::post('salon/add', [SalonController::class, 'createSalon']);
Route::put('salon/{id}', [SalonController::class, 'updateSalon']);
Route::delete('salon/{id}', [SalonController::class, 'deleteSalon']);
