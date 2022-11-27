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
    public function login(Request $request, EmailAuthService $emailAuthService)
    {
        $user = $emailAuthService->login($request);
        return response($user);
    }

    public function register(Request $request, EmailAuthService $emailAuthService){
        $user = $emailAuthService->register($request);
        return response($user);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        // $request->user()->currentAccessToken()->delete();
        auth()->logout();
        return response()->json(['status' => 401]);
    }
}
