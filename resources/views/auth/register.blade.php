@extends('layouts.main')

@section('title', 'Register')

@section('content')

<section class="py-5">
    <div class="container" style="max-width: 600px;">

        <h2 class="text-center mb-4" style="font-size:36px; font-weight:600;">
            Create Your Account
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Full Name -->
            <div class="mb-3">
                <label class="form-label" style="font-weight:600;">Full Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label" style="font-weight:600;">Email Address</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Ferry ID -->
            <div class="mb-3">
                <label class="form-label" style="font-weight:600;">Ferry ID</label>
                <input 
                    type="text" 
                    class="form-control @error('ferry_code') is-invalid @enderror" 
                    name="ferry_code"
                    value="{{ old('ferry_code') }}"
                    placeholder="FID0001"
                    required
                >

                @error('ferry_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label" style="font-weight:600;">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label" style="font-weight:600;">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="btn w-100"
                style="
                    background:#f7f2ee;
                    border:none;
                    padding:12px;
                    font-weight:600;
                    border-radius:10px;
                    transition:0.2s;
                "
                onmouseover="this.style.background='#e9dfd8'"
                onmouseout="this.style.background='#f7f2ee'"
            >
                Register
            </button>

            <p class="text-center mt-3">
                Already have an account?
                <a href="{{ route('login') }}" style="font-weight:600;">Login</a>
            </p>

        </form>
    </div>
</section>

@endsection
