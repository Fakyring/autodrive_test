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

//PHP Tasks
Route::get('city/{id}/salon', [SalonController::class, 'salonsCity']);
Route::get('city/{cid}/salon/{sid}', [SalonController::class, 'salonsCityInfo']);
Route::post('city/{id}/salon', [SalonController::class, 'addSalon']);
Route::put('city/{cid}/salon/{sid}', [SalonController::class, 'updateSalon']);
Route::delete('city/{cid}/salon/{sid}', [SalonController::class, 'deleteSalon']);
