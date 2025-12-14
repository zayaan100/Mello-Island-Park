@extends('layouts.main')

@section('content')

<div class="container py-5">

    <h1 class="mb-4" style="font-size:42px;font-weight:600;">
        Staff Dashboard
    </h1>

    <p class="mb-4">Welcome, {{ Auth::user()->name }}!</p>

    {{-- ========================================================= --}}
    {{--   STAFF ACTION BUTTONS                                   --}}
    {{-- ========================================================= --}}
    <div class="mb-5 d-flex gap-3 flex-wrap">

        {{-- EXISTING BUTTON --}}
        <a href="{{ route('staff.customers') }}" 
           style="
               background:#f7f2ee;
               padding:12px 24px;
               border-radius:12px;
               font-weight:600;
               text-decoration:none;
               color:#222;
               border:1px solid #e8e2de;
               transition:0.2s;
           "
           onmouseover="this.style.background='#e9dfd8'"
           onmouseout="this.style.background='#f7f2ee'">
           ➕ Make Booking for a Customer
        </a>

        {{-- ✅ NEW BUTTON (ADDED ONLY) --}}
        <a href="{{ route('staff.ferry.index') }}" 
           style="
               background:#f7f2ee;
               padding:12px 24px;
               border-radius:12px;
               font-weight:600;
               text-decoration:none;
               color:#222;
               border:1px solid #e8e2de;
               transition:0.2s;
           "
           onmouseover="this.style.background='#e9dfd8'"
           onmouseout="this.style.background='#f7f2ee'">
           🚢 Generate Ferry ID
        </a>

    </div>


    {{-- ========================================================= --}}
    {{--                         STYLES                           --}}
    {{-- ========================================================= --}}
    <style>
        .booking-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.07);
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 28px;
            font-weight: 600;
            margin-top: 40px;
        }
        .status-badge {
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
        }
        .status-booked {
            background: #e8f6ea;
            color: #1b8d3f;
        }
        .status-cancelled {
            background: #fce9e9;
            color: #c44242;
        }
        .cancel-btn {
            background: #f7f2ee;
            border: none;
            padding: 10px 22px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.2s;
        }
        .cancel-btn:hover {
            background: #e9dfd8;
        }
    </style>


    {{-- ========================================================= --}}
    {{-- ROOM BOOKINGS                                            --}}
    {{-- ========================================================= --}}
    <h2 class="section-title">Room Bookings</h2>

    {{-- ACTIVE --}}
    <h4 class="mt-3">Active Bookings</h4>
    @php $activeRooms = $roomBookings->where('status', 'booked'); @endphp

    @if($activeRooms->isEmpty())
        <p>No active room bookings.</p>
    @else
        <div class="row">
            @foreach($activeRooms as $booking)
            <div class="col-md-4">
                <div class="booking-card">
                    <h5>{{ $booking->room_name }}</h5>

                    <p>Guest: <strong>{{ $booking->user->name }}</strong></p>
                    <p>Check-in: <strong>{{ $booking->check_in }}</strong></p>
                    <p>Check-out: <strong>{{ $booking->check_out }}</strong></p>

                    <span class="status-badge status-booked">Booked</span>

                    <form method="POST" action="{{ route('staff.booking.cancel', ['type'=>'room','id'=>$booking->id]) }}">
                        @csrf
                        <button class="cancel-btn mt-3">Cancel</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    {{-- CANCELLED --}}
    @php $cancelledRooms = $roomBookings->where('status', 'cancelled'); @endphp

    <h4 class="mt-4">Cancelled Bookings</h4>

    @if($cancelledRooms->isEmpty())
        <p>No cancelled room bookings.</p>
    @else
        <div class="row">
            @foreach($cancelledRooms as $booking)
            <div class="col-md-4">
                <div class="booking-card">
                    <h5>{{ $booking->room_name }}</h5>

                    <p>Guest: <strong>{{ $booking->user->name }}</strong></p>
                    <p>Check-in: <strong>{{ $booking->check_in }}</strong></p>
                    <p>Check-out: <strong>{{ $booking->check_out }}</strong></p>

                    <span class="status-badge status-cancelled">Cancelled</span>
                </div>
            </div>
            @endforeach
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- SPA BOOKINGS                                             --}}
    {{-- ========================================================= --}}
    <h2 class="section-title mt-5">Spa Bookings</h2>

    {{-- ACTIVE --}}
    <h4 class="mt-3">Active Bookings</h4>
    @php $activeSpa = $spaBookings->where('status', 'booked'); @endphp

    @if($activeSpa->isEmpty())
        <p>No active spa bookings.</p>
    @else
        <div class="row">
            @foreach($activeSpa as $booking)
            <div class="col-md-4">
                <div class="booking-card">
                    <h5>{{ $booking->treatment_name }}</h5>

                    <p>Guest: <strong>{{ $booking->user->name }}</strong></p>
                    <p>Date: <strong>{{ $booking->date }}</strong></p>

                    <span class="status-badge status-booked">Booked</span>

                    <form method="POST" action="{{ route('staff.booking.cancel', ['type'=>'spa','id'=>$booking->id]) }}">
                        @csrf
                        <button class="cancel-btn mt-3">Cancel</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    {{-- CANCELLED --}}
    @php $cancelledSpa = $spaBookings->where('status', 'cancelled'); @endphp

    <h4 class="mt-4">Cancelled Bookings</h4>

    @if($cancelledSpa->isEmpty())
        <p>No cancelled spa bookings.</p>
    @else
        <div class="row">
            @foreach($cancelledSpa as $booking)
            <div class="col-md-4">
                <div class="booking-card">
                    <h5>{{ $booking->treatment_name }}</h5>

                    <p>Guest: <strong>{{ $booking->user->name }}</strong></p>
                    <p>Date: <strong>{{ $booking->date }}</strong></p>

                    <span class="status-badge status-cancelled">Cancelled</span>
                </div>
            </div>
            @endforeach
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- ACTIVITY BOOKINGS                                        --}}
    {{-- ========================================================= --}}
    <h2 class="section-title mt-5">Activity Bookings</h2>

    {{-- ACTIVE --}}
    <h4 class="mt-3">Active Bookings</h4>
    @php $activeAct = $activityBookings->where('status', 'booked'); @endphp

    @if($activeAct->isEmpty())
        <p>No active activity bookings.</p>
    @else
        <div class="row">
            @foreach($activeAct as $booking)
            <div class="col-md-4">
                <div class="booking-card">
                    <h5>{{ $booking->activity_name }}</h5>

                    <p>Guest: <strong>{{ $booking->user->name }}</strong></p>
                    <p>Date: <strong>{{ $booking->date }}</strong></p>

                    <span class="status-badge status-booked">Booked</span>

                    <form method="POST" action="{{ route('staff.booking.cancel', ['type'=>'activity','id'=>$booking->id]) }}">
                        @csrf
                        <button class="cancel-btn mt-3">Cancel</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    {{-- CANCELLED --}}
    @php $cancelledAct = $activityBookings->where('status', 'cancelled'); @endphp

    <h4 class="mt-4">Cancelled Bookings</h4>

    @if($cancelledAct->isEmpty())
        <p>No cancelled activity bookings.</p>
    @else
        <div class="row">
            @foreach($cancelledAct as $booking)
            <div class="col-md-4">
                <div class="booking-card">
                    <h5>{{ $booking->activity_name }}</h5>

                    <p>Guest: <strong>{{ $booking->user->name }}</strong></p>
                    <p>Date: <strong>{{ $booking->date }}</strong></p>

                    <span class="status-badge status-cancelled">Cancelled</span>
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>

@endsection
