<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Not logged in → must login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // Logged in but NOT admin
        if (Auth::user()->role !== 'admin') {
            return abort(403, 'Unauthorized: Admins only.');
        }

        return $next($request);
    }
}
