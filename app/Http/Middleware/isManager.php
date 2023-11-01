<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isManager
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user's category is "manager"
            if (Auth::user()->category->name === 'Manager') {
                return $next($request);
            }
        }

        // Redirect or return an error response if the user is not a manager
        return redirect()->route('dashboard')->with('error', 'Access denied. You must be a manager to access this page.');
    }
}
