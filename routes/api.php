<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TestTenantController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:passport')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth.api'], function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::get('/userTitle/{id}', [TitleController::class, 'getUserProfession']);
    Route::get('tenancies', [App\Http\Controllers\TestTenantController::class, 'tenancies']);
    // Professions
    // ->middleware('can:run_admin_or_superAdmin_ops');
    
    // Templates
    Route::resource('/template', TemplateController::class);
    // ->middleware('can:run_admin_or_superAdmin_ops');
    
    Route::post('tenant', [App\Http\Controllers\TestTenantController::class, 'create']);
    Route::put('template-update/{id}', [App\Http\Controllers\TestTenantController::class, 'update']);
});
Route::group(['middleware'=>'auth:api'], function(){
});
Route::resource('/profession', ProfessionController::class);
Route::apiResource('title', TitleController::class);
Route::get('countries', [CountryController::class, 'index']);
Route::get('states/{country_id}', [CountryController::class, 'states']);
Route::get('cities/{state_id}', [CountryController::class, 'cities']);
Route::post('verifyOTP', [AuthController::class, 'verifyOTP']);
// Email/Username
// Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
// Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
// Facebook
// Route::get('/login/{provider}/callback', [App\Http\Controllers\SocialController::class, 'callback']);
// Tw
// Route::get('/login/twitter', [App\Http\Controllers\SocialController::class, 'twRedirect']);
// Route::get('/login/twitter/callback', [App\Http\Controllers\SocialController::class, 'twCallback']);
// // Tw
// Route::get('/login/twitter', [App\Http\Controllers\SocialController::class, 'twRedirect']);
// Route::get('/login/twitter/callback', [App\Http\Controllers\SocialController::class, 'twCallback']);


// Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
