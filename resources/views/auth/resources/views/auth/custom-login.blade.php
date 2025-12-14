@extends('layouts.main')

@section('title', 'Login | Mellow Island Park')

@section('content')
<section class="py-5" style="background:#fafafa;">
  <div class="container text-center">
      <h2>Login</h2>
      <p>Please login to continue</p>

      <form method="POST" action="{{ route('custom.login') }}" class="mx-auto" style="max-width:400px;">
          @csrf

          <div class="form-group mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
          </div>

          <div class="form-group mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
          </div>

          <button class="btn btn-primary w-100">Login</button>
      </form>
  </div>
</section>
@endsection
