<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\TenantClaimController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Tenants\SocialController;
use App\Http\Controllers\AdminClientOrderController;

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
Route::get('/faqs', function () {
    return view('faqs');
});



Route::get('/preview/{templateId}', [App\Http\Controllers\TemplateController::class, 'renderTemplate']);

// Socialite
Route::get('/login/{provider}/callback', [App\Http\Controllers\SocialController::class, 'callback']);

// Auth
Route::prefix('auth')->group(function () {
    Route::get('/claim', [App\Http\Controllers\SettingController::class, 'claim']);
    Route::get('/login/{provider}', [App\Http\Controllers\SocialController::class, 'redirect']);
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/ante_login', [App\Http\Controllers\AuthController::class, 'login']);
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
Route::get('/guest-login/{code}', function (Request $request) {
    // $guestId = uniqid();

    $guestId = $request->code;
    Session::put('guest_id', $guestId);

    // Log in the guest as a temporary user
    Auth::loginUsingId($guestId);

    // Redirect or perform any other necessary action
    // return redirect('/dashboard');
});
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
        if (Auth::user()) {
            return view('admin.client');
        } else {
            return view('auth.login');
        }
    });
    Route::get('/dashboard', function () {
        if (Auth::user()) {
            return view('admin.dashboard');
        } else {
            return view('auth.login');
        }
    });
    Route::get('/mail', function () {
        if (Auth::user()) {
            return view('admin.mail');
        } else {
            return view('auth.login');
        }
    });
    Route::get('/settings', function () {
        if (Auth::user()) {
            return view('admin.settings');
        } else {
            return view('auth.login');
        }
    });
    Route::get('/template', function () {
        if (Auth::user()) {
            return view('admin.template');
        } else {
            return view('auth.login');
        }
    });
    Route::get('/password-change', function () {
        if (Auth::user()) {
            return view('shared.changepassview');
        } else {
            return view('auth.login');
        }
    });
});
/**
 * Newly Added for developer
 */
Route::prefix('developers')->group(function () {
    Route::get('auth/signup', [DeveloperController::class, 'showSignupForm']);
    Route::middleware(['auth', 'can:run_dev_ops'])->group(function () {
        Route::get('/dashboard', function () {
            return view('developers.dashboard');
        });
        Route::get('/projects', function () {
            return view('developers.project');
        });
    });
});
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/user/invoice/{invoice}/{user}', function (Request $request, $invoiceId) {
    $user = User::find($request->user);
    return $user->downloadInvoice($invoiceId, [
        'vendor' => 'White Coat Domain',
        'product' => 'Premium plan',
        'email' => 'manager@whitecoatdomain.com',
        'url' => 'https://whitecoatdomain.com',
    ]);
});
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
    Route::get('/developers', function () {
        return view('admin.developers');
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
    Route::get('/developers', function () {
        return view('admin.developers');
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

// #TODOs: Create a middleware that checks the session of a user and get the token to compare against one in DB
// Save token and DB to session on route visitation


Route::middleware(['validateIsValidGuest'])->group(function () {
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

    // After verifying email save to admin client orders
    Route::put('/admin_order/{tenant_id}', [AdminClientOrderController::class, 'update']);

    Route::get('/claim/data', [TenantClaimController::class, 'getData']);


    Route::post('/subscription/create', [App\Http\Controllers\SubscriptionController::class, 'subscribe']);
    // Route::get('/testModal', function(){
    //     return view('test');
    // });
});
Route::get('/getstarted', [TenantClaimController::class, 'checkIfTenantIDNGetDomain']);

// Define a route to handle the webhook
Route::post('/webhook', [WebhookController::class, 'handle']);