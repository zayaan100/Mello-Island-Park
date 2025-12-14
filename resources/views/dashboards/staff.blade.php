@extends('layouts.main')

@section('title', 'Staff Dashboard')

@section('content')

<style>
    .section-title {
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 25px;
    }
    .table-card {
        background: #ffffff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.07);
        margin-bottom: 45px;
    }
    .cancel-btn {
        background: #f7f2ee;
        border: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 600;
    }
    .cancel-btn:hover {
        background: #e9dfd8;
    }
    .badge-status {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 13px;
    }
    .badge-booked {
        background: #d9f7d9;
        color: #145a14;
    }
    .badge-cancelled {
        background: #fae1df;
        color: #9f2b24;
    }
</style>

<div class="container py-5">

    <h1 class="mb-5" style="font-size:48px;font-weight:600;">
        Staff Dashboard
    </h1>


    {{-- ==================== ROOM BOOKINGS ======================= --}}
    <div class="table-card">
        <h2 class="section-title">Room Bookings</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roomBookings as $b)
                        <tr>
                            <td>{{ $b->user->name }}</td>
                            <td>{{ $b->room_name }}</td>
                            <td>{{ $b->check_in }}</td>
                            <td>{{ $b->check_out }}</td>
                            <td>
                                <span class="badge-status badge-{{ $b->status == 'booked' ? 'booked' : 'cancelled' }}">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            <td>
                                @if($b->status == 'booked')
                                <form method="POST" action="{{ route('staff.booking.cancel', ['type' => 'room', 'id' => $b->id]) }}">
                                    @csrf
                                    <button class="cancel-btn">Cancel</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No room bookings found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    {{-- ==================== SPA BOOKINGS ======================= --}}
    <div class="table-card">
        <h2 class="section-title">Spa & Wellness Bookings</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Treatment</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($spaBookings as $b)
                        <tr>
                            <td>{{ $b->user->name }}</td>
                            <td>{{ $b->treatment_name }}</td>
                            <td>{{ $b->date }}</td>
                            <td>
                                <span class="badge-status badge-{{ $b->status == 'booked' ? 'booked' : 'cancelled' }}">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            <td>
                                @if($b->status == 'booked')
                                <form method="POST" action="{{ route('staff.booking.cancel', ['type' => 'spa', 'id' => $b->id]) }}">
                                    @csrf
                                    <button class="cancel-btn">Cancel</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No spa bookings found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    {{-- ==================== ACTIVITY BOOKINGS ======================= --}}
    <div class="table-card">
        <h2 class="section-title">Activity Bookings</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Activity</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activityBookings as $b)
                        <tr>
                            <td>{{ $b->user->name }}</td>
                            <td>{{ $b->activity_name }}</td>
                            <td>{{ $b->date }}</td>
                            <td>
                                <span class="badge-status badge-{{ $b->status == 'booked' ? 'booked' : 'cancelled' }}">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            <td>
                                @if($b->status == 'booked')
                                <form method="POST" action="{{ route('staff.booking.cancel', ['type' => 'activity', 'id' => $b->id]) }}">
                                    @csrf
                                    <button class="cancel-btn">Cancel</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No activity bookings found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
