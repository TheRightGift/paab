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
})->name('index');
Route::get('/templates', function () {
    return view('template');
});


// Socialite
Route::get('/login/{provider}/callback', [App\Http\Controllers\SocialController::class, 'callback']);

// Auth
Route::prefix('auth')->group(function () {
    Route::get('/login/{provider}', [App\Http\Controllers\SocialController::class, 'redirect']);
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/verifyEmailForRegistration', [App\Http\Controllers\AuthController::class, 'verifyEmailForRegistration']);
    Route::post('/sendOtpForUserResetPassword', [App\Http\Controllers\AuthController::class, 'sendOtpForUserResetPassword']);
    Route::post('/resetPassword', [App\Http\Controllers\AuthController::class, 'resetPassword']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/auth/resetpassword', function () {
        return view('auth.resetpassword');
    });
    Route::get('/createpassword', function () {
        return view('auth.createpassword');
    });
    Route::get('/getstarted', function () {
        if (Auth::user()) {
            return redirect('/dashboard');
        } else {
            return view('auth.started');
        }
    });
    Route::get('/login', function () {
        if (Auth::user()) {
            return redirect('/dashboard');
        } else {
            return view('auth.login');
        }    
    });
    Route::get('/resetpassword', function () {
        if (Auth::user()) {
            return redirect('/dashboard');
        } else {
            return view('auth.resetpassword');
        }    
    });
});
Route::prefix('client')->middleware(['auth', 'can:run_client_ops'])->group(function () {
    Route::get('/websites', function () {
        return view('client.websites');
    }); //->middleware('can:run_client_ops')
    Route::get('/dashboard', function () {
        return view('client.dashboard');
    });
    Route::get('/mail', function () {
        return view('client.mail');
    });
    Route::get('/settings', function () {
        return view('client.settings');
    });
    Route::get('/support', function () {
        return view('client.support');
    });
    
    Route::get('/singlemail', function () {
        return view('client.singlemail');
    });
    Route::get('/setupwebsite', function () {
        return view('client.setupwebsite');
    });
    Route::get('/template', function () {
        return view('client.template');
    });
});
Route::get('/templates/physiciansportfolio', function () {
    return view('templates.physiciansportfolio');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
