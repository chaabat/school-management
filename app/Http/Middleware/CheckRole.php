<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user has the required role
            if (Auth::user()->role->name == $role) {
                // User has the required role, allow access
                return $next($request);
            }
        }

        // User does not have the required role, redirect or show error page
        return redirect()->route('unauthorized'); // You can customize this route or response as needed
    }
}
