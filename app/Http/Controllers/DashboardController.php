<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
            } elseif(auth()->user()->can('run_admin_ops')) {
                // redirect to admin dash view
            } elseif(auth()->user()->can('run_superAdmin_ops')) {
                // redirect to super admin
            } else {
                return new Response('Unauthorized access', 401);
            }
        } else {
            return redirect('/');
        }
        
    }

}
