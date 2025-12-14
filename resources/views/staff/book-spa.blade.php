@extends('layouts.main')

@section('content')
<div class="container py-5">

    <h1 class="mb-4" style="font-weight:600;">
        Book Spa Treatment for {{ $customer->name }}
    </h1>

    <h4 class="mb-3">{{ $spa->name }}</h4>

    <p class="text-muted mb-4">
        Price: ${{ $spa->price }} / person
    </p>

    <style>
        .form-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.07);
        }
        .submit-btn {
            background: #f7f2ee;
            border: none;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.2s;
            color: #222;
        }
        .submit-btn:hover {
            background: #e9dfd8;
        }
    </style>

    {{-- ERRORS --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">

        <form method="POST" action="{{ route('staff.spa.store', ['customerId' => $customer->id, 'treatmentName' => $spa->name]) }}">
            @csrf

            {{-- DATE --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            {{-- NUMBER OF PEOPLE --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Number of People</label>
                <input type="number" name="people" class="form-control" min="1" max="4" required>
            </div>

            <button type="submit" class="submit-btn mt-3">
                Confirm Spa Booking
            </button>

        </form>

    </div>

</div>
@endsection
