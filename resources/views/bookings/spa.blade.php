@extends('layouts.main')

@section('title', 'Book '.$treatmentName)

@section('content')

<style>
    .booking-card {background:#ffffff;border-radius:18px;box-shadow:0 6px 16px rgba(0,0,0,0.07);padding:32px;max-width:720px;margin:40px auto;}
    .booking-label {font-weight:600;margin-bottom:4px;}
    .booking-btn {background:#f7f2ee;border:none;padding:12px 32px;border-radius:10px;font-weight:600;}
    .booking-btn:hover {background:#e9dfd8;}
</style>

<div class="container py-5">
    <div class="booking-card">
        <h2 class="mb-3" style="font-size:32px;font-weight:600;">Book {{ $treatmentName }}</h2>
        <p class="mb-4">
            <strong>${{ $price }} / person ·</strong>
            <span class="text-success">Slots available</span>
        </p>

        <form method="POST" action="{{ route('spa.book.confirm', ['treatmentName' => $treatmentName]) }}">
            @csrf
            <input type="hidden" name="price" value="{{ $price }}">

            <div class="mb-3">
                <label class="booking-label">Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                @error('date') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="booking-label">Number of guests</label>
                <input type="number" name="people" class="form-control" min="1" max="4"
                       value="{{ old('people', 1) }}">
                @error('people') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="booking-btn">Review &amp; Confirm</button>
        </form>
    </div>
</div>
@endsection
