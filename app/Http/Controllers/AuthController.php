<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Services\Auth\EmailAuthService;

class AuthController extends Controller
{
    public function pre_login(Request $request, EmailAuthService $emailAuthService)
    {
        $user = $emailAuthService->pre_login($request);
        return response($user);
    }

    public function login(Request $request, EmailAuthService $emailAuthService)
    {
        $user = $emailAuthService->login($request);
        return response($user);
    }
    

    public function changePassword (Request $request, EmailAuthService $emailAuthService) {
        $service = $emailAuthService->changePassword($request);
        return response($service);
    }

    public function check_password (EmailAuthService $emailAuthService) {
        $service = $emailAuthService->check_password();
        return response($service);
    }

    public function tenantlogin(Request $request, EmailAuthService $emailAuthService)
    {
        $user = $emailAuthService->tenantlogin($request);
        return response($user);
    }

    public function register(Request $request, EmailAuthService $emailAuthService){
        $user = $emailAuthService->register($request);
        return response($user);
    }
    
    public function verifyEmailForWebsiteEdit(Request $request, EmailAuthService $emailAuthService){
        $verifierRes = $emailAuthService->verifyEmailForWebsiteEdit($request);
        return response($verifierRes);
    }


    public function verifyEmailForRegistration(Request $request, EmailAuthService $emailAuthService){
        $verifierRes = $emailAuthService->verifyEmailForRegistration($request);
        return response($verifierRes);
    }

    public function sendOtpForUserResetPassword(Request $request, EmailAuthService $emailAuthService){
        $sendOtpres = $emailAuthService->sendOtpForUserResetPassword($request);
        return response($sendOtpres);
    }

    public function resetPassword(Request $request, EmailAuthService $emailAuthService){
        $passResetRes = $emailAuthService->resetPassword($request);
        return response($passResetRes);
    }

    public function verifyOTP(Request $request, EmailAuthService $emailAuthService) {
        $verifier = $emailAuthService->verifyOtps($request);
        return response()->json($verifier);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        auth()->logout();
        return response()->json(['status' => 401]);
    }
}
