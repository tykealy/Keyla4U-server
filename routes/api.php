<?php

use App\Http\Controllers\Api\PaymentApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginApi;
use App\Http\Controllers\Api\RegisterUserApi;
use App\Http\Controllers\Api\ClubApi;
use App\Http\Controllers\Api\LocationApi;
use App\Http\Controllers\Api\PayApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterUserApi::class, 'store']);
Route::post('/login', [LoginApi::class, 'store']);

Route::get('/clubs', [ClubApi::class, 'index']);
Route::get('/clubs/{id}', [ClubApi::class, 'show']);

Route::get('/locations', [LocationApi::class, 'index']);

Route::get("/sports", [App\Http\Controllers\Api\SportApi::class, 'index']);

Route::get('/pitches/{courtID}', [App\Http\Controllers\Api\PitchApi::class, 'index']);

Route::get('availableTimes/{pitchID}/{WeekDay}', [App\Http\Controllers\Api\AvailableTimeApi::class, 'index']);

Route::post('/availableTimes/book', [App\Http\Controllers\Api\AvailableTimeApi::class, 'book']);
Route::post('/order', [PaymentApi::class, 'order']);
Route::get('/payment/{orderId}', [App\Http\Controllers\Api\PaymentApi::class, 'payment']);
Route::post('/pay/{orderId}', [PayApi::class, 'pay']);

// Route::middleware(['cors'])->group(function () {
//     Route::post('/order', [PaymentApi::class, 'order']);
// });
