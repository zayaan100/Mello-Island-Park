@extends('layouts.main')

@section('title', 'Customer Dashboard')

@section('content')

@php
    use Carbon\Carbon;

    // Get active room booking
    $activeRoom = $roomBookings->where('status', 'booked')->sortBy('check_in')->last();
    $hasRoom = $activeRoom !== null;

    // Only needed for displaying info (NOT validation)
    if ($hasRoom) {
        $roomStarts = Carbon::parse($activeRoom->check_in);
        $roomEnds   = Carbon::parse($activeRoom->check_out);
    }
@endphp

<style>
    .item-card {
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 16px rgba(0,0,0,0.07);
        transition: 0.3s;
    }
    .item-card:hover { transform: translateY(-5px); }

    .item-img {
        width: 100%;
        height: 260px;
        object-fit: cover;
        background: #f5f5f5;
    }

    .book-btn {
        background: #f7f2ee;
        padding: 12px 28px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        transition: 0.2s;
        display: inline-block;
        text-decoration: none;
        color: #222;
    }
    .book-btn:hover {
        background: #e9dfd8;
        color: #222;
    }

    .warning-box {
        background: #fff3cd;
        border-left: 5px solid #ffca2c;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .booking-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 18px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        margin-bottom: 15px;
    }

    .cancel-small {
        background: #f7f2ee;
        border: none;
        padding: 6px 14px;
        border-radius: 10px;
        font-weight: 600;
        color: #222;
    }
    .cancel-small:hover { background: #e9dfd8; }
</style>

<div class="container py-5">

    <h1 class="text-center mb-5" style="font-size:48px;font-weight:600;">
        Welcome, {{ Auth::user()->name }}
    </h1>

    {{-- ============================= --}}
    {{--     ROOM STAY INFORMATION     --}}
    {{-- ============================= --}}
    @if(!$hasRoom)
        <div class="warning-box">
            ⚠ <strong>You do not have any room booking.</strong><br>
            Spa and Activity bookings will only be accepted within room stay dates.
        </div>
    @else
        <div class="warning-box" style="background:#e7f4ff; border-left-color:#2196f3;">
            ✅ Your stay is from 
            <strong>{{ $roomStarts->toFormattedDateString() }}</strong>
            to 
            <strong>{{ $roomEnds->toFormattedDateString() }}</strong>.
            <br>
            You may book Spa and Activities within these dates.
        </div>
    @endif



    {{-- ============================= --}}
    {{--         ROOMS SECTION         --}}
    {{-- ============================= --}}
    <h2 class="mt-5 mb-4" style="font-size:36px;font-weight:600;">Rooms</h2>

    <div class="row g-4">
        @foreach ($rooms as $room)
        <div class="col-md-4">
            <div class="item-card">
                <img class="item-img" src="{{ $room->image ? asset('storage/'.$room->image) : asset('images/default-room.jpg') }}" alt="{{ $room->name }}">

                <div class="p-4">
                    <h4>{{ $room->name }}</h4>
                    <p>{{ $room->description }}</p>

                    <p class="mb-2"><strong>From ${{ $room->price }} / night</strong></p>
                    <p class="text-muted mb-2">Capacity: {{ $room->capacity }} persons</p>

                    <a href="{{ route('room.book.form', ['roomName' => $room->name]) }}" class="book-btn">Book Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>



    {{-- ============================= --}}
    {{--        SPA SECTION            --}}
    {{-- ============================= --}}
    <h2 class="mt-5 mb-4" style="font-size:36px;font-weight:600;">Spa & Wellness</h2>

    <div class="row g-4">
        @foreach ($spaItems as $spa)
        <div class="col-md-4">
            <div class="item-card">

                <img class="item-img" 
                     src="{{ $spa->image_path ? asset('storage/'.$spa->image_path) : asset('images/default-spa.jpg') }}" 
                     alt="{{ $spa->name }}">

                <div class="p-4">
                    <h4>{{ $spa->name }}</h4>
                    <p>{{ $spa->description }}</p>

                    <p class="mb-2"><strong>${{ $spa->price }} / person</strong></p>

                    {{-- Always allowed. Actual restrictions handled in controller. --}}
                    <a href="{{ route('spa.book.form', ['treatmentName' => $spa->name]) }}" class="book-btn">Book Now</a>
                </div>

            </div>
        </div>
        @endforeach
    </div>



    {{-- ============================= --}}
    {{--       ACTIVITIES SECTION      --}}
    {{-- ============================= --}}
    <h2 class="mt-5 mb-4" style="font-size:36px;font-weight:600;">Island Activities</h2>

    <div class="row g-4">
        @foreach ($activities as $activity)
        <div class="col-md-4">
            <div class="item-card">

                <img class="item-img" 
                     src="{{ $activity->image ? asset('storage/'.$activity->image) : asset('images/default-activity.jpg') }}" 
                     alt="{{ $activity->name }}">

                <div class="p-4">
                    <h4>{{ $activity->name }}</h4>
                    <p>{{ $activity->description }}</p>

                    <p class="mb-2"><strong>${{ $activity->price }} / person</strong></p>

                    {{-- Always allowed. Actual date check handled in controller. --}}
                    <a href="{{ route('activity.book.form', ['activityName' => $activity->name]) }}" class="book-btn">Book Now</a>
                </div>

            </div>
        </div>
        @endforeach
    </div>



    {{-- ============================= --}}
    {{--       MY BOOKINGS SECTION     --}}
    {{-- ============================= --}}
    <h2 class="mt-5 mb-4" style="font-size:36px;font-weight:600;">My Bookings</h2>

    {{-- ROOM BOOKINGS --}}
    <h4 class="mt-4">Room Bookings</h4>
    @forelse ($roomBookings as $booking)
        <div class="booking-card d-flex justify-content-between">
            <div>
                <strong>{{ $booking->room_name }}</strong><br>
                Check-in: {{ $booking->check_in }}<br>
                Check-out: {{ $booking->check_out }}<br>
                Status: <strong>{{ ucfirst($booking->status) }}</strong>
            </div>

            @if($booking->status === 'booked')
            <form method="POST" action="{{ route('customer.booking.room.cancel', $booking->id) }}">
                @csrf
                <button class="cancel-small">Cancel</button>
            </form>
            @endif
        </div>
    @empty
        <p class="text-muted">No room bookings yet.</p>
    @endforelse


    {{-- SPA BOOKINGS --}}
    <h4 class="mt-4">Spa Bookings</h4>
    @forelse ($spaBookings as $booking)
        <div class="booking-card d-flex justify-content-between">
            <div>
                <strong>{{ $booking->treatment_name }}</strong><br>
                Date: {{ $booking->date }}<br>
                Status: <strong>{{ ucfirst($booking->status) }}</strong>
            </div>

            @if($booking->status === 'booked')
            <form method="POST" action="{{ route('customer.booking.spa.cancel', $booking->id) }}">
                @csrf
                <button class="cancel-small">Cancel</button>
            </form>
            @endif
        </div>
    @empty
        <p class="text-muted">No spa bookings yet.</p>
    @endforelse


    {{-- ACTIVITY BOOKINGS --}}
    <h4 class="mt-4">Activity Bookings</h4>
    @forelse ($activityBookings as $booking)
        <div class="booking-card d-flex justify-content-between">
            <div>
                <strong>{{ $booking->activity_name }}</strong><br>
                Date: {{ $booking->date }}<br>
                Status: <strong>{{ ucfirst($booking->status) }}</strong>
            </div>

            @if($booking->status === 'booked')
            <form method="POST" action="{{ route('customer.booking.activity.cancel', $booking->id) }}">
                @csrf
                <button class="cancel-small">Cancel</button>
            </form>
            @endif
        </div>
    @empty
        <p class="text-muted">No activity bookings yet.</p>
    @endforelse

</div>

@endsection
