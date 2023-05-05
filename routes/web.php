<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClubController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get(
    '/',
    function(){
        return redirect('/dashboard');
    }
)->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// club

Route::resource('club', ClubController::class)->middleware('auth');

// Route::get('/club', function () {
//     return view('club.edit');
// })->name('club.edit');

// Route::get('club/index', function () {
//     return view('club.index');
// })->name('club.index');

// Route::get('club/update', function () {
//     return view('club.edit');
// })->name('club.update');

// Route::get('club/create', function () {
//     return view('club.create');
// })->name('club.create');

// Route::get('club/delete', function () {
//     return view('club.index');
// })->name('club.delete');

// court category
Route::get('/category', function () {
    return view('court_category.index');
})->name('category.index');

Route::get('category/create', function () {
    return view('court_category.create');
})->name('category.create');

Route::get('category/update', function () {
    return view('court_category.edit');
})->name('category.update');

Route::get('category/delete', function () {
    return view('court_category.index');
})->name('category.delete');

//dashboard

Route::get('dashboard',function(){
    return view('admin.dashboard');
})->name('dashboard');


// court 
Route::get('/court', function () {
    return view('court.index');
})->name('court.index');

Route::get('court/create', function () {
    return view('court.create');
})->name('court.create');

Route::get('court/update', function () {
    return view('court.edit');
})->name('court.update');

Route::get('court/delete', function () {
    return view('court.index');
})->name('court.delete');

// pitch 
Route::get('/pitch', function () {
    return view('pitch.index');
})->name('pitch.index');

Route::get('pitch/create', function () {
    return view('pitch.create');
})->name('pitch.create');

Route::get('pitch/update', function () {
    return view('pitch.edit');
})->name('pitch.update');

Route::get('pitch/delete', function () {
    return view('pitch.index');
})->name('pitch.delete');

// available pitch 
Route::get('/available_pitch', function () {
    return view('available_pitch.index');
})->name('available_pitch.index');

Route::get('available_pitch/create', function () {
    return view('available_pitch.create');
})->name('available_pitch.create');

Route::get('available_pitch/update', function () {
    return view('available_pitch.edit');
})->name('available_pitch.update');

Route::get('available_pitch/delete', function () {
    return view('available_pitch.index');
})->name('available_pitch.delete');


// User
Route::get('/user', function () {
    return view('user.index');
})->name('user.index');

Route::get('user/create', function () {
    return view('user.create');
})->name('user.create');

Route::get('user/update', function () {
    return view('user.edit');
})->name('user.update');

Route::get('user/delete', function () {
    return view('user.index');
})->name('user.delete');

//favorite

Route::get('/favorite', function(){
    return view('favorite.index');
})->name('favorite.index');