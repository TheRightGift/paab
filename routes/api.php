<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\ProfessionController;
use App\Http\Controller\TemplateController;
use App\Http\Controller\TestTenantController;

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


Route::group(['middleware'=>'auth:api'], function(){
    // Professions
    Route::resource('/profession', ProfessionController::class)->middleware('can:run_admin_or_superAdmin_ops');

    // Templates
    Route::resource('/template', TemplateController::class)->middleware('can:run_admin_or_superAdmin_ops');

    Route::post('tenant', [App\Http\Controllers\TestTenantController::class, 'create']);
    Route::post('template-update', [App\Http\Controllers\TestTenantController::class, 'update']);
    Route::get('tenancies', [App\Http\Controllers\TestTenantController::class, 'tenancies']);
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
