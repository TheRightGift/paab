<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Tenants\BioController;


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
Route::post('/tenant/auth/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => 'auth.api'], function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::get('/userTitle/{id}', [TitleController::class, 'getUserProfession']);
    Route::get('tenancies', [App\Http\Controllers\TenantController::class, 'tenancies']);
    Route::get('/userLocationDets/{id}', [App\Http\Controllers\CountryController::class, 'getRelation']);
    Route::put('/updateUser/{id}', [App\Http\Controllers\SettingController::class, 'updateUser']);
    // Templates
    Route::resource('/template', TemplateController::class);
    Route::get('/templates', [TemplateController::class, 'getIndex']);
    Route::put('/deleteTemplate/{id}', [TemplateController::class, 'delete']);
    Route::patch('/approveTemplate/{id}', [TemplateController::class, 'approve']);
    Route::post('/admin', [App\Http\Controllers\DashboardController::class, 'admin']);
    Route::put('/access/{id}', [App\Http\Controllers\AdminClientOrderController::class, 'update']);
    Route::get('/access', [App\Http\Controllers\AdminClientOrderController::class, 'index']);
    Route::post('checkMailExist', [App\Http\Controllers\TenantController::class, 'checkEmail']);
    Route::post('tenant', [App\Http\Controllers\TenantController::class, 'create']);
    Route::put('template-update/{id}', [App\Http\Controllers\TenantController::class, 'update']);
});
Route::group(['middleware'=>'auth:api'], function(){
});
Route::get('template', [TemplateController::class, 'index']);
Route::resource('/profession', ProfessionController::class);
Route::apiResource('title', TitleController::class);
Route::get('countries', [CountryController::class, 'index']);
Route::get('states/{country_id}', [CountryController::class, 'states']);
Route::get('cities/{state_id}', [CountryController::class, 'cities']);
Route::post('verifyOTP', [AuthController::class, 'verifyOTP']);
