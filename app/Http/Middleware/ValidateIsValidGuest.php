<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ValidateIsValidGuest
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
        $expectedData = $request->query('code');

        if (Session::get('your_data_key') !== $expectedData) {
            // Data does not match, handle the error (e.g., redirect, return response, etc.)
            return redirect('/error');
        }

        return $next($request);
    }
}
