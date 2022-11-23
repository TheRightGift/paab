<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Email/Username
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
// Facebook
Route::get('/login/{provider}/callback', [App\Http\Controllers\SocialController::class, 'callback']);
// Tw
// Route::get('/login/twitter', [App\Http\Controllers\SocialController::class, 'twRedirect']);
// Route::get('/login/twitter/callback', [App\Http\Controllers\SocialController::class, 'twCallback']);
// // Tw
// Route::get('/login/twitter', [App\Http\Controllers\SocialController::class, 'twRedirect']);
// Route::get('/login/twitter/callback', [App\Http\Controllers\SocialController::class, 'twCallback']);


Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
