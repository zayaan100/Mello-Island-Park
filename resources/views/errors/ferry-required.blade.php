@extends('layouts.main')

@section('content')
<div class="container text-center py-5">
    <h2>Ferry ID Required</h2>
    <p>You must have a valid Ferry ID to access this page.</p>

    <a href="{{ route('customer.dashboard') }}"
       class="btn mt-3"
       style="background:#f7f2ee;padding:10px 22px;border-radius:10px;font-weight:600;">
        Back to Dashboard
    </a>
</div>
@endsection
