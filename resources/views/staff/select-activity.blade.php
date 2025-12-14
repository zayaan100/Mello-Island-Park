@extends('layouts.main')

@section('content')
<div class="container py-5">

    <h1 class="mb-4" style="font-weight:600;">
        Select an Activity for {{ $customer->name }}
    </h1>

    <p class="text-muted mb-5">
        Activity date must be within the customer's booked room stay.
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
        @foreach($activities as $activity)
        <div class="col-md-4">
            <div class="item-card">

                <h4>{{ $activity->name }}</h4>
                <p class="text-muted">{{ $activity->description }}</p>
                <p class="text-muted">Price: ${{ $activity->price }}</p>

                <a href="{{ route('staff.activity.form', ['customerId' => $customer->id, 'activityName' => $activity->name]) }}"
                   class="select-btn">Select Activity</a>

            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
