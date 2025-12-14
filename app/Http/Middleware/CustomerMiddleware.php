<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    public function handle($request, Closure $next)
    {
        // Must be logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // Must be customer
        if (Auth::user()->role !== 'customer') {
            return abort(403, 'Unauthorized: Customers only.');
        }

        return $next($request);
    }
}
