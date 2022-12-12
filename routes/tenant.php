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
});
// ['middleware'=>'auth:api']
Route::middleware(['auth:api',InitializeTenancyByDomain::class,
PreventAccessFromCentralDomains::class,])->prefix('api')->group(function () {
    Route::get('/bio', [App\Http\Controllers\Tenants\BioController::class, 'index']);
    Route::post('/bio', [App\Http\Controllers\Tenants\BioController::class, 'store']);
    Route::put('/bio/{id}', [App\Http\Controllers\Tenants\BioController::class, 'update']);
    Route::delete('/bio/{id}', [App\Http\Controllers\Tenants\BioController::class, 'destroy']);

    Route::get('/achievement', [App\Http\Controllers\Tenants\AchievementController::class, 'index']);
    Route::post('/achievement', [App\Http\Controllers\Tenants\AchievementController::class, 'store']);
    Route::put('/achievement/{id}', [App\Http\Controllers\Tenants\AchievementController::class, 'update']);
    Route::delete('/achievement/{id}', [App\Http\Controllers\Tenants\AchievementController::class, 'destroy']);

    Route::get('/contact', [App\Http\Controllers\Tenants\ContactController::class, 'index']);
    Route::post('/contact', [App\Http\Controllers\Tenants\ContactController::class, 'store']);
    Route::put('/contact/{id}', [App\Http\Controllers\Tenants\ContactController::class, 'update']);
    Route::delete('/contact/{id}', [App\Http\Controllers\Tenants\ContactController::class, 'destroy']);

    Route::get('/image', [App\Http\Controllers\Tenants\ImageController::class, 'index']);
    Route::post('/image', [App\Http\Controllers\Tenants\ImageController::class, 'store']);
    Route::put('/image/{id}', [App\Http\Controllers\Tenants\ImageController::class, 'update']);
    Route::delete('/image/{id}', [App\Http\Controllers\Tenants\ImageController::class, 'destroy']);

 });