<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\TenantClaimController;
use App\Http\Controllers\TenantController;

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



Route::get('/preview/{templateId}', [App\Http\Controllers\TemplateController::class, 'renderTemplate']);

// Socialite
Route::get('/login/{provider}/callback', [App\Http\Controllers\SocialController::class, 'callback']);

// Auth
Route::prefix('auth')->group(function () {
    Route::get('/claim', [App\Http\Controllers\SettingController::class, 'claim']);
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
// 'auth',
Route::prefix('client')->middleware(['auth', 'can:run_client_ops'])->group(function () {
    Route::get('/websites', function () {
        return view('client.websites');
    }); //->middleware('can:run_client_ops')
    Route::get('/dashboard', [App\Http\Controllers\TenantController::class, 'claim']);

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
    Route::get('/password-change', function () {
        return view('shared.changepassview');
    });
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'can:run_admin_ops'])->group(function () {
    Route::get('/client', function () {
        return view('admin.client');
    });
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/mail', function () {
        return view('admin.mail');
    });
    Route::get('/settings', function () {
        return view('admin.settings');
    });
    Route::get('/template', function () {
        return view('admin.template');
    });
    Route::get('/password-change', function () {
        return view('shared.changepassview');
    });
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'can:run_admin_ops'])->group(function () {
    Route::get('/client', function () {
        return view('admin.client');
    }); //->middleware('can:run_client_ops')
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/messages', function () {
        return view('admin.messages');
    });
    Route::get('/settings', function () {
        return view('admin.settings');
    });
    Route::get('/template', function () {
        return view('admin.template');
    });
    Route::get('/singlemsg', function () {
        return view('admin.singlemsg');
    });
});

Route::prefix('supre')->middleware(['auth', 'can:run_superAdmin_ops'])->group(function () {
    Route::get('/dashboard', function () {
        return view('super.dashboard');
    });
    Route::get('/admins', function() {
        return view('super.admins');
    });
    Route::get('/template', function() {
        return view('super.template');
    });
    Route::get('/mail', function() {
        return view('super.mail');
    });
    Route::get('/singlemail', function() {
        return view('super.singlemail');
    });
    Route::get('/settings', function() {
        return view('super.settings');
    });
    Route::get('/client', function() {
        return view('super.client');
    });
    Route::get('/password-change', function () {
        return view('shared.changepassview');
    });
});

Route::post('claim/saveuser', [TenantClaimController::class, 'saveUserDets']);

Route::put('claim/updatebio', [TenantClaimController::class, 'updateUserBio']);

Route::put('claim/updateDomain/{tenant}', [TenantController::class, 'update']);

Route::get('claim/getTenantDomain', [TenantController::class, 'checkTenantNGetDets']);

Route::put('claim/updateAvatar/{bio}', [TenantClaimController::class, 'updateUserPhoto']);

Route::post('claim/saveUndergrad', [TenantClaimController::class, 'updateUserUndergradSchoolTime']);

Route::post('claim/savemedicalschooltime', [TenantClaimController::class, 'saveMedicalSchoolTime']);

Route::post('claim/saveinternship', [TenantClaimController::class, 'saveInternshipTime']);

Route::post('claim/savefellowship', [TenantClaimController::class, 'saveFellowshipTime']);

Route::post('claim/saveresidency', [TenantClaimController::class, 'saveResidencyTime']);

Route::post('claim/saveexperience', [TenantClaimController::class, 'saveExperinceTime']);

Route::post('claim/save/additonalqualification', [TenantClaimController::class, 'saveAdditionalSchoolTime']);

Route::post('claim/save/service', [TenantClaimController::class, 'saveServiceOffered']);

Route::post('claim/successdomainregistra', [TenantClaimController::class, 'sendMailForDomainRegistry']);


Route::get('/claim/data', [TenantClaimController::class, 'getData']);


Route::post('/subscription/create', [App\Http\Controllers\SubscriptionController::class, 'subscribe']);
Route::get('/testModal', function(){
    return view('test');
});
