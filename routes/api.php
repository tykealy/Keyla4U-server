<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginApi;
use App\Http\Controllers\Api\RegisterUserApi;
use App\Http\Controllers\Api\ClubApi;

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
