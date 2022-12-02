<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/templates', function () {
    return view('template');
});
Route::get('/auth/getstarted', function () {
    if (Auth::user()) {
        return redirect('/dashboard');
    } else {
        return view('auth.started');
    }
});
Route::get('/auth/login', function () {
    if (Auth::user()) {
        return redirect('/dashboard');
    } else {
        return view('auth.login');
    }    
});
Route::get('/auth/resetpassword', function () {
    if (Auth::user()) {
        return redirect('/dashboard');
    } else {
        
    }    
});

// Socialite
Route::get('/login/{provider}', [App\Http\Controllers\SocialController::class, 'redirect']);

// Auth
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/verifyEmailForRegistration', [App\Http\Controllers\AuthController::class, 'verifyEmailForRegistration']);
Route::post('/sendOtpForUserResetPassword', [App\Http\Controllers\AuthController::class, 'sendOtpForUserResetPassword']);
Route::post('/resetPassword', [App\Http\Controllers\AuthController::class, 'resetPassword']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

// Dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
