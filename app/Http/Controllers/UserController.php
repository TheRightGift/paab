<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;

class StateController extends Controller
{
    public function storeWithEmail(Request $request) {
        $inputs = Validator::make($request->all(), [
            'firstname' => ['nullable'],
            'email' => 'required|unique:users',
            'lastname' => ['nullable'],
            'password' => ['required'],
        ]); 
        
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();

            $input = $inputs->validated();
            $input['password'] = Hash::make($input['password']);
            $input['role'] = 'Admin';
            $admin = User::create($input);
            return response(['admin' => $admin, 'message' => 'Created Success'], 201);
        }
    }

}