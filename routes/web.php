<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.started');
});
Route::get('/auth/login', function () {
    return view('auth.login');
});
Route::get('/auth/otp', function () {
    return view('auth.otp');
});


Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
// Socialite
Route::get('/login/{provider}', [App\Http\Controllers\SocialController::class, 'redirect']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/verifyEmailForRegistration', [App\Http\Controllers\AuthController::class, 'verifyEmailForRegistration']);
Route::post('/emailVerification', [App\Http\Controllers\AuthController::class, 'emailVerification']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
