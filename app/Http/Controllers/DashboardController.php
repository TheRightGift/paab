<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            if (auth()->user()->can('run_client_ops')){
                // redirect to client dash view
                return redirect('/client/dashboard');
            } else if(auth()->user()->can('run_admin_ops')) {
                // redirect to admin dash view
                return redirect('/admin/dashboard');
            } else if(auth()->user()->can('run_superAdmin_ops')) {
                // redirect to super admin
                return redirect('/supre/dashboard');
            } else {
                return new Response('Unauthorized access', 401);
            }
        } else {
            return redirect('/');
        }
        
    }

    public function admin(Request $request) {
        $inputs = Validator::make($request->all(), [
            'firstname' => ['required'],
            'email' => 'required|unique:users',
            'lastname' => ['required'],
            'othername' => ['nullable'],
            'password' => ['nullable'],
            'role' => ['required'],
        ]); 
        
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $input['password'] = bcrypt($input['email']);
            $input['role'] = 'Admin';
            $admin = User::create($input);
            return response(['admin' => $admin, 'message' => 'Created Success'], 201);
        } 
    }
    
}
