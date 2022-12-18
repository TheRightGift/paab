<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class TenantAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check the cookie part to ensure a tenant cookie is set
        // If isset take the user to /settings
        // else take the user to the tenant login part
        if ($request->hasCookie('verifier')) {
            // return redirect('/auth.login');
        }
        // $token = $request->cookie('verifier');
        // $request->headers->add(['Authorization' => 'Bearer ' . $token]);
        // if (!$request->bearerToken()) {

        //     tenancy()->central(function ($tenant) {
        //         dd(User::all(), $tenant);
        //         $auth = User::find($tenant->user_id);
        //         if ($auth !== null) {
    
        //         }

        //     });
        // }
        return redirect('/auth.verify');
        return $next($request);
    }
}
