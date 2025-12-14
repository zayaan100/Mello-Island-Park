@extends('layouts.main')

@section('title', 'Select Customer')

@section('content')
<div class="container py-5">

    <h1 class="mb-4" style="font-size:36px;font-weight:600;">
        Select a Customer
    </h1>

    <p class="mb-4">Choose a customer to make a booking on their behalf.</p>

    <style>
        .customer-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.07);
            margin-bottom: 18px;
            transition: 0.2s;
        }
        .customer-card:hover {
            transform: translateY(-4px);
        }
        .select-btn {
            background: #f7f2ee;
            padding: 10px 22px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            color: #222;
            border: none;
        }
        .select-btn:hover {
            background: #e9dfd8;
        }
    </style>

    @if($customers->isEmpty())
        <p>No customers found.</p>
    @else
        <div class="row">
            @foreach($customers as $customer)
            <div class="col-md-4">
                <div class="customer-card">

                    <h4>{{ $customer->name }}</h4>
                    <p class="text-muted">Email: {{ $customer->email }}</p>

                    {{-- UPDATED ROUTE NAME --}}
                    <a href="{{ route('staff.booking.select', $customer->id) }}" 
                       class="select-btn mt-2">
                        Select Customer
                    </a>

                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
