<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\LandController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\LandsController;
use App\Http\Controllers\RentLandController;
use App\Http\Middleware\isValid;
use Illuminate\Support\Facades\Route;

// ================================================================
// ------------------------- Home Routes --------------------------
// ================================================================
Route::get('/',[AccountController::class, 'index'])->name('home');


// ================================================================
// ------------------------- Lands Routes -------------------------
// ================================================================
Route::get('/lands',[LandsController::class,'index'])->name('landPage');

Route::get('/land-details/{id}',[LandsController::class,'landDetail'])->name('landDetailPage');

Route::get('/logout-function',[AccountController::class,'logout'])->name('logout.function');

Route::get('/search', [LandsController::class,'search'])->name('search');


// ================================================================
// --------------------- Authentication Routes --------------------
// ================================================================
Route::get('/login', function () {
    return view('login');
})->name('loginPage');
Route::post('/login-function',[AccountController::class, 'login'])->name('login.function');
Route::get('/register', function () {
    return view('register');
})->name('registerPage');
Route::post('/register-function', [AccountController::class,'register'])->name('register.function');


// ================================================================
// ------------------------ Admin Routes --------------------------
// ================================================================
Route::middleware([isValid::class])->group(function () {
    Route::get('/admin/dashboard',[AccountController::class,'index'])->name('adminDashboard');

    Route::resource('/admin/users', UserController::class);

    Route::resource('/admin/lands', LandController::class);

    Route::resource('/rent-land', RentLandController::class);
    
    Route::get('/applied-lands', [LandsController::class,'appliedLands'])->name('applied-land');
});
