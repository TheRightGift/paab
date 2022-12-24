<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
Use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
Use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', [App\Http\Controllers\TenantController::class, 'template']);

    Route::get('/setting', [App\Http\Controllers\TenantController::class, 'setting']);
});
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/setting', [App\Http\Controllers\TenantController::class, 'setting']);
});
// ['middleware'=>'auth:api']
Route::middleware(['auth:api',InitializeTenancyByDomain::class,
PreventAccessFromCentralDomains::class,])->prefix('api')->group(function () {
    
    Route::post('/bio', [App\Http\Controllers\Tenants\BioController::class, 'store']);
    Route::put('/bio/{id}', [App\Http\Controllers\Tenants\BioController::class, 'update']);
    Route::delete('/bio/{id}', [App\Http\Controllers\Tenants\BioController::class, 'destroy']);

    Route::post('/achievement', [App\Http\Controllers\Tenants\AchievementController::class, 'store']);
    Route::put('/achievement/{id}', [App\Http\Controllers\Tenants\AchievementController::class, 'update']);
    Route::delete('/achievement/{id}', [App\Http\Controllers\Tenants\AchievementController::class, 'destroy']);

    Route::post('/promotion', [App\Http\Controllers\Tenants\PromotionController::class, 'store']);
    Route::put('/promotion/{id}', [App\Http\Controllers\Tenants\PromotionController::class, 'update']);
    Route::delete('/promotion/{id}', [App\Http\Controllers\Tenants\PromotionController::class, 'destroy']);

    Route::post('/contact', [App\Http\Controllers\Tenants\ContactController::class, 'store']);
    Route::put('/contact/{id}', [App\Http\Controllers\Tenants\ContactController::class, 'update']);
    Route::delete('/contact/{id}', [App\Http\Controllers\Tenants\ContactController::class, 'destroy']);
    
    Route::post('/general', [App\Http\Controllers\Tenants\GeneralController::class, 'store']);
    Route::put('/general/{id}', [App\Http\Controllers\Tenants\GeneralController::class, 'update']);
    Route::delete('/general/{id}', [App\Http\Controllers\Tenants\GeneralController::class, 'destroy']);
    
    Route::post('/service', [App\Http\Controllers\Tenants\ServiceController::class, 'store']);
    Route::put('/service/{id}', [App\Http\Controllers\Tenants\ServiceController::class, 'update']);
    Route::delete('/service/{id}', [App\Http\Controllers\Tenants\ServiceController::class, 'destroy']);
    
    Route::post('/social', [App\Http\Controllers\Tenants\SocialController::class, 'store']);
    Route::put('/social/{id}', [App\Http\Controllers\Tenants\SocialController::class, 'update']);
    Route::delete('/social/{id}', [App\Http\Controllers\Tenants\SocialController::class, 'destroy']);
    
    Route::post('/contact', [App\Http\Controllers\Tenants\ContactController::class, 'store']);
    Route::put('/contact/{id}', [App\Http\Controllers\Tenants\ContactController::class, 'update']);
    Route::delete('/contact/{id}', [App\Http\Controllers\Tenants\ContactController::class, 'destroy']);

    Route::post('/review', [App\Http\Controllers\Tenants\ReviewsController::class, 'store'])->withoutMiddleware(['auth:api']);
    Route::put('/review/{id}', [App\Http\Controllers\Tenants\ReviewsController::class, 'update']);
    Route::delete('/review/{id}', [App\Http\Controllers\Tenants\ReviewsController::class, 'destroy']);
    
    Route::post('/imagedel', [App\Http\Controllers\Tenants\GeneralController::class, 'deleteImage']);
    
    Route::post('/verifyToken', [App\Http\Controllers\TenantController::class, 'verifyToken'])->withoutMiddleware(['auth:api']);
    Route::post('/savelogin', [App\Http\Controllers\TenantController::class, 'saveAccessToken'])->withoutMiddleware(['auth:api']);
    
    Route::post('/schedule', [App\Http\Controllers\Tenants\MessagesController::class, 'store'])->withoutMiddleware(['auth:api']);
    Route::get('/review', [App\Http\Controllers\Tenants\ReviewsController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::get('/achievement', [App\Http\Controllers\Tenants\AchievementController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::get('/promotion', [App\Http\Controllers\Tenants\PromotionController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::get('/bio', [App\Http\Controllers\Tenants\BioController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::get('/contact', [App\Http\Controllers\Tenants\ContactController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::get('/social', [App\Http\Controllers\Tenants\SocialController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::get('/service', [App\Http\Controllers\Tenants\ServiceController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::get('/contact', [App\Http\Controllers\Tenants\ContactController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::get('/general', [App\Http\Controllers\Tenants\GeneralController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::get('/activePromo', [App\Http\Controllers\Tenants\PromotionController::class, 'getLatestInTime'])->withoutMiddleware(['auth:api']);
});