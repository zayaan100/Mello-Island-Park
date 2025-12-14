@extends('layouts.main')

@section('title', $title ?? 'Confirm Booking')

@section('content')

<style>
    .confirm-card {background:#ffffff;border-radius:18px;box-shadow:0 6px 16px rgba(0,0,0,0.07);padding:32px;max-width:720px;margin:40px auto;}
    .confirm-btn {background:#f7f2ee;border:none;padding:12px 32px;border-radius:10px;font-weight:600;}
    .confirm-btn:hover {background:#e9dfd8;}
    .back-link {margin-right:16px;text-decoration:none;color:#555;}
</style>

<div class="container py-5">
    <div class="confirm-card">
        <h2 class="mb-4" style="font-size:32px;font-weight:600;">
            {{ $title ?? 'Confirm Booking' }}
        </h2>

        <p class="mb-3">Please review your details before confirming:</p>

        <ul class="list-unstyled mb-4">
            @foreach($details as $label => $value)
                <li class="mb-1">
                    <strong>{{ $label }}:</strong> {{ $value }}
                </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ $storeRoute }}">
            @csrf
            @foreach($hidden as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <a href="{{ url()->previous() }}" class="back-link">← Go back and edit</a>
            <button type="submit" class="confirm-btn">Confirm Booking</button>
        </form>
    </div>
</div>
@endsection
