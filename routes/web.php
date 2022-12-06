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
        return view('auth.resetpassword');
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

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/websites', function () {
    return view('client.websites');
}); //->middleware('can:run_client_ops')

Route::get('/client/mail', function () {
    return view('client.mail');
});
Route::get('/client/settings', function () {
    return view('client.settings');
});
Route::get('/client/support', function () {
    return view('client.support');
});
Route::get('/auth/resetpassword', function () {
    return view('auth.resetpassword');
});
Route::get('/auth/createpassword', function () {
    return view('auth.createpassword');
});
Route::get('/client/singlemail', function () {
    return view('client.singlemail');
});
Route::get('/client/setupwebsite', function () {
    return view('client.setupwebsite');
});
Route::get('/templates/physiciansportfolio', function () {
    return view('templates.physiciansportfolio');
});
Route::get('/client/template', function () {
    return view('client.template');
});