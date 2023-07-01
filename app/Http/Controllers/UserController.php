<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    public function storeWithEmail(Request $request) {
        $inputs = Validator::make($request->all(), [
            'firstname' => ['nullable'],
            'email' => 'required|unique:users',
            'lastname' => ['nullable'],
            'password' => ['required'],
            'role' => ['required'],
        ]); 
        
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();

            $input = $inputs->validated();
            $input['password'] = Hash::make($input['password']);
            // $input['role'] = $in;
            $users = new User();
            $user = $users->create($input);
            return response(['user' => $user, 'message' => 'Created Success'], 201);
        }
    }
    public function updateUser(Request $request, $id) {
        $inputs = Validator::make($request->all(), [
            'firstname' => ['nullable'],
            'lastname' => ['nullable'],
            'title_id' => ['nullable'],
            'gender' => ['nullable'],
        ]); 
        
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $user = User::find($id);
            $user->update($input);
            return response(['user' => $user, 'message' => 'Created Success'], 201);
        }
    }

}