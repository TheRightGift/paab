<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DomainCheckerController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TenantClaimController;


use App\Http\Controllers\Tenants\BioController;
use App\Http\Middleware\AuthBasicChecker;

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
Route::post('/tenant/auth/login', [App\Http\Controllers\AuthController::class, 'pre_login']);
Route::post('/tenant/auth/ante_login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['prefix' => 'v1'], function(){
    // For when user trys to create domain, user is not authenticated yet;
    //    TODO: Remember to create another endpoint for storing payment data, when logged in
    Route::get('/user/setup-intent', [App\Http\Controllers\SubscriptionController::class, 'getSetupIntent']);
    Route::post('/user/payments', [App\Http\Controllers\SubscriptionController::class, 'postPaymentMethods']);
    Route::get('/user/payment-methods', [App\Http\Controllers\SubscriptionController::class, 'getPaymentMethods']);
    Route::put('/user/subscription', [App\Http\Controllers\SubscriptionController::class, 'updateSubscription']);
    Route::post('/user/remove-payment', [App\Http\Controllers\SubscriptionController::class, 'removePaymentMethod'])->middleware('auth.api');
});

Route::group(['prefix' => 'services', 'middleware' => 'client'], function() {
    Route::post('/tenant', [App\Http\Controllers\TenantController::class, 'create']);
    Route::post('/create_bio',  [App\Http\Controllers\Tenants\BioController::class, 'store']);
    Route::post('/send_claim_mail', [TenantController::class, 'sendEmail']);
    Route::post('/interest', [InterestController::class, 'store']);
    Route::post('/saveIntrest', [InterestController::class, 'saveInterestForUser']);
    Route::get('/remove_tenant_with_faultycr8/{id}', [MaintenanceController::class, 'removeUser']);
    Route::get('/remove_tenants_with_faultycr8', [MaintenanceController::class, 'checkTenantNRemoveIfBioIsEmpty']);
    Route::get('/remove_tenant/{id}', [MaintenanceController::class, 'removeTenant']);
});

Route::group(['middleware' => ['auth.api']], function() {
    Route::post('/admin_send_mail', [MailController::class, 'adminSendToClients']);
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::get('/userTitle/{id}', [TitleController::class, 'getUserProfession']);
    Route::get('tenancies', [App\Http\Controllers\TenantController::class, 'tenancies']);
    Route::get('/userLocationDets/{id}', [App\Http\Controllers\CountryController::class, 'getRelation']);
    Route::put('/updateUser/{id}', [App\Http\Controllers\SettingController::class, 'updateUser']);
    // Templates
    Route::resource('/template', TemplateController::class)->except('index');
    Route::get('/templates', [TemplateController::class, 'getIndex']);
    Route::put('/deleteTemplate/{id}', [TemplateController::class, 'delete']);
    Route::patch('/approveTemplate/{id}', [TemplateController::class, 'approve']);
    Route::post('/admin', [App\Http\Controllers\DashboardController::class, 'admin']);
    Route::put('/access/{id}', [App\Http\Controllers\AdminClientOrderController::class, 'update']);
    Route::get('/access', [App\Http\Controllers\AdminClientOrderController::class, 'index']);
    Route::post('checkMailExist', [App\Http\Controllers\TenantController::class, 'checkEmail']);
    Route::post('tenant', [App\Http\Controllers\TenantController::class, 'create'])->middleware('client');
    Route::put('template-update/{id}', [App\Http\Controllers\TenantController::class, 'update']);
    Route::get('/admins', [App\Http\Controllers\DashboardController::class, 'getAdmins']);
    Route::delete('/deleteAdmin/{id}', [App\Http\Controllers\DashboardController::class, 'deleteAdmin']);
    Route::put('/updateAdmin/{id}', [App\Http\Controllers\DashboardController::class, 'updateAdmin']);
    Route::patch('/changePassword', [App\Http\Controllers\AuthController::class, 'changePassword']);
    Route::get('/check_password', [App\Http\Controllers\AuthController::class, 'check_password']);
    Route::post('/sendClaimMail', [TenantController::class, 'sendEmail']);

    // Route::get('/remove_tenants_with_faultycr8', [MaintenanceController::class, 'checkTenantNRemoveIfBioIsEmpty'])->middleware('can:run_superAdmin_ops');
    Route::get('/get_tenants_with_faultycr8', [MaintenanceController::class, 'loopThruTenantsWithFaultyCr8'])->middleware('can:run_superAdmin_ops');
    Route::get('/remove_tenant_with_faultycr8/{id}', [MaintenanceController::class, 'removeUser'])->middleware('can:run_superAdmin_ops');
    Route::get('/getSubscribers', [SubscriptionController::class, 'getSubscribers'])->middleware('can:run_superAdmin_ops');
    Route::get('/getusers_that_made_change', [MaintenanceController::class, 'checkUsersThatMadeChanges'])->middleware('can:run_superAdmin_ops');
    
});
// Route::group(['middleware'=>'auth:api'], function(){
// });
Route::get('template', [TemplateController::class, 'index']);
Route::resource('/profession', ProfessionController::class);
Route::apiResource('title', TitleController::class);
Route::get('countries', [CountryController::class, 'index']);
Route::get('states/{country_id}', [CountryController::class, 'states']);
Route::get('cities/{state_id}', [CountryController::class, 'cities']);
Route::post('verifyOTP', [AuthController::class, 'verifyOTP']);
Route::post('domain/check', [DomainCheckerController::class, 'check']);
Route::get('interests', [InterestController::class, 'index']);
// No auth required
Route::post('tenant_without_auth', [App\Http\Controllers\TenantController::class, 'create']);
// Route::get('getCities/{startRow}', [CountryController::class, 'getCities']);
// Route::post('insertCity', [CountryController::class, 'insertCity']);
Route::get('/getStateNCity/{city}', [CountryController::class, 'getCountryStateFromCity']);

Route::get('/test_awsutil/{stripe_id}', [APIController::class, 'registerDomain'])->name('api.domain.register')->middleware(AuthBasicChecker::class);
Route::get('/sendcommand/{domainName}', [APIController::class, 'runAWSUtilityCommand'])->name('api.aws.sendcommand')->middleware(AuthBasicChecker::class);
Route::get('/getpendingwebsite', [APIController::class, 'getPendingSites'])->middleware(AuthBasicChecker::class);
Route::post('/support', [SupportController::class,'supportSaveData']);