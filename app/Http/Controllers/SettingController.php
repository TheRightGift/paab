<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Tenant;
use App\Models\AdminClientOrder;

use Validator;
use DB;
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
            $input['gender'] = $input['gender'] === 'null' ? 'M' : $input['gender'];
            $user2Update = User::find($user)->update($input);
            if ($user2Update == true) {
                return response(['user' => $user2Update, 'message' => 'Update Success', 'status' => 200], 200);
            }
        }
    }

    public function claim(Request $request) {
        $searchTenant = $request->query('claimable');
        $searchEmail = $request->query('mail');
        if (!empty($searchTenant) && !empty($searchEmail)) {
            $request->session()->put('tenant', $searchTenant);
            $request->session()->put('email', $searchEmail);
            $request->session()->save();
        
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                $orders = AdminClientOrder::where([['tenant_id', $searchTenant], ['claimed', null], ['email', $searchEmail]])->first();
                if (!empty($orders)) {
                    \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
            
                    DB::connection('mysql')->reconnect();
                    DB::setDatabaseName($tenant->tenancy_db_name);
                    // Check the bio and get the names eg. FNAME, LNAME, ONAME
                    $userBiography = DB::table('bios')->get();
                    return redirect('auth/getstarted')->with(['userBiography' => $userBiography]);
                }
                else {
                    return redirect('auth/login');
                }
            }
            else {
                return redirect('auth/login');
            }

        }
        else {
            return redirect('auth/login');
        }
    }
}
