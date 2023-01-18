<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
class SettingController extends Controller
{
    public function updateUser(Request $request, $userID) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            // 'othername' => 'nullable',
            'zipcode' => 'nullable',
            'phone' => 'nullable',
            'title_id' => 'nullable',
            'city_id' => 'nullable',
            'gender' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpg,png|max:200|'
        ]);
        if ($validator->fails()) {
            return response($validator->errors()->all(), 400);
        } else {
            $input = $validator->validated();
            if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $ext = $request->file('avatar')->getClientOriginalExtension();
                $name = strtolower($input['firstname'].$input['lastname'].$userID).'.'.$ext;
                $avatar->move(public_path('/media/img/avatars/'), $name);
                
                $input['avatar'] = $name;
            } 
            $user = auth()->user()->id;
            $user2Update = User::find($user)->update($input);
            if ($user2Update == true) {
                return response(['user' => $user2Update, 'message' => 'Update Success', 'status' => 200], 200);
            }
        }
    }
}
