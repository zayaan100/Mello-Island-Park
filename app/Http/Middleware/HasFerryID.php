<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasFerryID
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // User must be logged in AND have a Ferry ID
        if (!auth()->check() || !auth()->user()->hasFerryID()) {
            return redirect()->route('ferry.required');
        }

        return $next($request);
    }
}
