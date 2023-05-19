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
use App\Http\Controllers\AdminRegisterController;

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

Route::get('/',function(){ return redirect('/dashboard');})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// club
    Route::resource('club', ClubController::class)->middleware('admin');
// court category
    Route::resource('court_category', CourtCategoryController::class)->middleware('admin');
//dashboard
    Route::get('dashboard',function(){return view('admin.dashboard');})->middleware('admin')->name('dashboard');
// court 
    Route::resource('court', CourtController::class)->middleware('admin');
// pitch 
    Route::resource('pitch', PitchController::class)->middleware('admin');

// pitch available time 
    Route::get('pitch_available_time', [availableTimeController::class, 'index'])->middleware('admin')->name('available_time.index');
    Route::Post('getPitch', [availableTimeController::class, 'getPitch'])->middleware('admin')->name('available_time.getPitch');
    Route::Post('getDate', [availableTimeController::class, 'getDate'])->middleware('admin')->name('available_time.getDate');
    Route::Post('getAvailableTime', [availableTimeController::class, 'getAvailableTime'])->middleware('admin')->name('available_time.getAvailableTime');
//favorite
    Route::get('/favorite', function(){return view('favorite.index');})->middleware('admin')->name('favorite.index');
//order
    Route::get('/order',[OrderController::class,'index'])->middleware('admin')->name('order.index');


// ================== Super admin =======================

//super admin dashboard
// Define the SuperDashboard route
Route::get('/super_admin_dashboard',function(){return view('super_admin.superDashboard');})->middleware('superAdmin')->name('super_admin_dashboard');;

//super_admin_clubs
Route::resource('/clubs', ClubsController::class)->middleware('superAdmin');
Route::get('/search_club',[ClubsController::class, 'getBySearch'])->middleware('superAdmin')->name('clubs.search');
Route::get('/createWithUserId',[ClubsController::class, 'createWithUserId'])->middleware('superAdmin')->name('clubs.createWithUserId');
// User
Route::resource('/user', UserController::class);
Route::get('/search_user',[UserController::class, 'getBySearch'])->middleware('superAdmin')->name('user.search');

//register 
Route::get('/admin_register',[AdminRegisterController::class,'index'])->middleware('superAdmin')->name('admin_register');
Route::post('/admin_register',[AdminRegisterController::class,'store'])->middleware('superAdmin')->name('admin_register');

