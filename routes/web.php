<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CourtCategoryController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\PitchController;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\availableTimeController;
use App\Http\Controllers\OrderController;

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

Route::get('/',function(){ return redirect('/dashboard');})->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// club
    Route::resource('club', ClubController::class);
// court category
    Route::resource('court_category', CourtCategoryController::class);
//dashboard
    Route::get('dashboard',function(){return view('admin.dashboard');})->name('dashboard');
// court 
    Route::resource('court', CourtController::class);
// pitch 
    Route::resource('pitch', PitchController::class);

// pitch available time 
    Route::get('pitch_available_time', [availableTimeController::class, 'index'])->name('available_time.index');
    Route::Post('getPitch', [availableTimeController::class, 'getPitch'])->name('available_time.getPitch');
    Route::Post('getDate', [availableTimeController::class, 'getDate'])->name('available_time.getDate');
    Route::Post('getAvailableTime', [availableTimeController::class, 'getAvailableTime'])->name('available_time.getAvailableTime');

//favorite
    Route::get('/favorite', function(){
        return view('favorite.index');
    })->name('favorite.index');

//order
    Route::get('/order',[OrderController::class,'index'])->name('order.index');

//order detail
Route::get('/order_detail', function(){
    return view('order_detail.index');
})->name('order_detail.index');
Route::get('order_detail/create', function(){
    return view('order_detail.create');
})->name('order_detail.create');




// ================== Super admin =======================

//super admin dashboard
Route::get('/super_admin_dashboard', function(){
    return view('super_admin.superDashboard');
})->name('super_admin_dashboard');

//super_admin_clubs
Route::resource('/clubs', ClubsController::class);
Route::get('/search_club',[ClubsController::class, 'getBySearch'])->name('clubs.search');

// User
Route::resource('/user', UserController::class);
Route::get('/search_user',[UserController::class, 'getBySearch'])->name('user.search');
