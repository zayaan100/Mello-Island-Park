<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login attempt.
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();

            // ADMIN REDIRECT
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            // STAFF REDIRECT
            if ($user->role === 'staff') {
                return redirect('/staff/dashboard');
            }

            // CUSTOMER REDIRECT
            return redirect('/customer/dashboard');
        }

        // Login failed
        return back()->withErrors(['email' => 'Invalid login credentials']);
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
