<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect users based on role.
     */
    protected function authenticated($request, $user)
    {
        // ADMIN
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        // STAFF
        if ($user->role === 'staff') {
            return redirect('/staff/dashboard');
        }

        // CUSTOMER (default)
        return redirect('/customer/dashboard');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
