@extends('layouts.main')

@section('content')
<div class="container py-5">

    <h1 class="mb-4" style="font-weight:600;">
        Select a Room for {{ $customer->name }}
    </h1>

    <p class="text-muted mb-5">
        Choose a room to book for this customer.
    </p>

    <style>
        .item-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.07);
            transition: 0.25s;
            margin-bottom: 20px;
        }
        .item-card:hover {
            transform: translateY(-5px);
        }
        .select-btn {
            margin-top: 10px;
            background: #f7f2ee;
            padding: 10px 22px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            color: #222;
            display: inline-block;
        }
        .select-btn:hover {
            background: #e9dfd8;
        }
    </style>

    <div class="row">
        @foreach($rooms as $room)
        <div class="col-md-4">
            <div class="item-card">

                <h4>{{ $room->name }}</h4>
                <p class="text-muted">Price: ${{ $room->price }}</p>
                <p class="text-muted">Capacity: {{ $room->capacity }} Guests</p>

                <a href="{{ route('staff.room.form', ['customerId' => $customer->id, 'roomName' => $room->name]) }}"
                   class="select-btn">Select Room</a>

            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
