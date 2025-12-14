@extends('layouts.main')

@section('title', 'Login')

@section('content')

<div class="container py-5" style="max-width:500px;">

    <h1 class="text-center mb-4" style="font-size:42px;font-weight:600;">Login</h1>

    <!-- IMPORTANT: Point to custom login route -->
    <form method="POST" action="{{ route('custom.login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <button type="submit" class="btn btn-primary w-100" 
                style="background:#f7f2ee;border:0;color:#000;font-weight:600;">
            Login
        </button>

    </form>

</div>

@endsection
