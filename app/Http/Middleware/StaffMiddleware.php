<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StaffMiddleware
{
    public function handle($request, Closure $next)
    {
        // User must be logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // User must have role=staff
        if (Auth::user()->role !== 'staff') {
            return abort(403, 'Unauthorized: Staff only.');
        }

        return $next($request);
    }
}
