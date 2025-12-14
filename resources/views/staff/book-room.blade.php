@extends('layouts.main')

@section('content')
<div class="container py-5">

    <h1 class="mb-4" style="font-weight:600;">
        Book Room for {{ $customer->name }}
    </h1>

    <h4 class="mb-3">{{ $room->name }}</h4>

    <p class="text-muted mb-4">
        Capacity: {{ $room->capacity }} guests <br>
        Price: ${{ $room->price }} / night
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

        <form method="POST" action="{{ route('staff.room.store', ['customerId' => $customer->id, 'roomName' => $room->name]) }}">
            @csrf

            {{-- CHECK-IN --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Check-in</label>
                <input type="date" name="check_in" class="form-control" required>
            </div>

            {{-- CHECK-OUT --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Check-out</label>
                <input type="date" name="check_out" class="form-control" required>
            </div>

            {{-- GUESTS --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Number of Guests</label>
                <input type="number" name="guests" class="form-control" min="1" max="{{ $room->capacity }}" required>
            </div>

            <button type="submit" class="submit-btn mt-3">
                Confirm Room Booking
            </button>
        </form>

    </div>

</div>
@endsection
