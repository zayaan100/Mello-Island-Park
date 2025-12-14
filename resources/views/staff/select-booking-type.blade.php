@extends('layouts.main')

@section('content')
<div class="container py-5">

    <h1 class="mb-4" style="font-weight:600;">
        Booking Options For {{ $customer->name }}
    </h1>

    <p class="text-muted mb-5">
        Select what type of booking you want to make for this customer.
    </p>

    <style>
        .option-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.07);
            transition: 0.25s;
            text-align: center;
        }
        .option-card:hover {
            transform: translateY(-6px);
        }
        .option-btn {
            margin-top: 15px;
            background: #f7f2ee;
            border: none;
            padding: 12px 26px;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.2s;
            color: #222;
            text-decoration: none;
            display: inline-block;
        }
        .option-btn:hover {
            background: #e9dfd8;
        }
    </style>

    <div class="row g-4">

        {{-- ROOM BOOKING --}}
        <div class="col-md-4">
            <div class="option-card">
                <h4>Room Booking</h4>
                <p>Book a room stay for this customer.</p>

                <a href="{{ route('staff.select.room', $customer->id) }}"
                   class="option-btn">
                    Select Room
                </a>
            </div>
        </div>

        {{-- SPA BOOKING --}}
        <div class="col-md-4">
            <div class="option-card">
                <h4>Spa Treatment</h4>
                <p>Book a spa treatment within the stay period.</p>

                <a href="{{ route('staff.select.spa', $customer->id) }}"
                   class="option-btn">
                    Select Spa
                </a>
            </div>
        </div>

        {{-- ACTIVITY BOOKING --}}
        <div class="col-md-4">
            <div class="option-card">
                <h4>Island Activity</h4>
                <p>Book an activity during their stay.</p>

                <a href="{{ route('staff.select.activity', $customer->id) }}"
                   class="option-btn">
                    Select Activity
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
