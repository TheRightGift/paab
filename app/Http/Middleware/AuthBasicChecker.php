<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthBasicChecker
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
        $auth_header = $request->header('Authorization');

        if ($auth_header !== null) {
            $auth_token = str_replace('Basic ', '', $auth_header);
            $expected_token = base64_encode(env('API_KEY')); // Replace with your expected token

            if ($auth_token === $expected_token) {
                // Authorization header is correct
                return $next($request);
            } else {
                // Authorization header is incorrect
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            // Authorization header is missing
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
