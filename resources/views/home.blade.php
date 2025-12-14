@extends('layouts.main')

@section('title', 'Mellow Island Park')

@section('content')

{{-- ========================== HERO SECTION ========================== --}}
<section id="hero" class="hero-wrapper" data-aos="fade-up">

    <style>
        /* HERO SECTION */
        .hero-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 80px 5%;
            gap: 40px;
        }

        .hero-text {
            max-width: 550px;
        }

        .hero-title {
            font-size: 64px;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 25px;
        }

        .hero-subtext {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        .hero-btn {
            background: #f7f2ee;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            color: #222;
            font-weight: 600;
            border: 2px solid transparent;
            transition: 0.2s;
        }

        .hero-btn:hover {
            background: #e9dfd8;
            border-color: #c5b7ae;
        }

        /* HERO IMAGE */
        .hero-img {
            width: 580px;
            height: 430px;
            object-fit: cover;
            border-radius: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        @media (max-width: 992px) {
            .hero-wrapper {
                flex-direction: column;
                text-align: center;
            }
            .hero-img {
                width: 100%;
                height: auto;
            }
        }
    </style>

    <div class="hero-text">
        <h1 class="hero-title">Discover<br>Mellow Island<br>Park</h1>

        <p class="hero-subtext">
            Welcome to Hotel Mellow, where comfort meets tranquility. Designed for
            relaxation and luxury living.
        </p>

        <a href="#rooms" class="hero-btn">Explore Rooms</a>
    </div>

    <img src="{{ asset('images/hero-1.jpg') }}" class="hero-img" alt="Resort Room">

</section>



{{-- ========================== ABOUT SECTION ========================== --}}
@include('includes.about')



{{-- GLOBAL CARD STYLING --}}
<style>
    .item-card {
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 16px rgba(0,0,0,0.07);
        transition: 0.3s;
    }
    .item-card:hover {
        transform: translateY(-5px);
    }
    .item-img {
        width: 100%;
        height: 260px;
        object-fit: cover;
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

    .disabled-btn {
        background: #ddd;
        padding: 12px 28px;
        border-radius: 10px;
        color: #777;
        font-weight: 600;
        cursor: not-allowed;
        display: inline-block;
    }
</style>



{{-- ========================== ROOMS SECTION ========================== --}}
<section id="rooms" class="padding-large" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <h3 class="display-3 fw-normal text-center">Our Rooms</h3>

        <div class="row mt-5 g-4">

            @foreach ($rooms as $room)
            <div class="col-lg-4">
                <div class="item-card">
                    <img src="{{ asset('storage/'.$room->image) }}" class="item-img" alt="{{ $room->name }}">

                    <div class="p-4">
                        <h4>{{ $room->name }}</h4>
                        <p>{{ $room->description }}</p>

                        <p class="mb-2"><strong>${{ $room->price }} / night</strong></p>

                        @auth
                            @php $role = Auth::user()->role; @endphp

                            @if($role === 'customer')
                                <a href="{{ route('room.book.form', ['roomName' => $room->name]) }}" class="book-btn">
                                    Book Now
                                </a>

                            @elseif($role === 'admin')
                                <a href="{{ route('admin.rooms.index') }}" class="book-btn" style="background:#e7f0ff;">
                                    Modify
                                </a>

                            @elseif($role === 'staff')
                                <span class="disabled-btn">View Only</span>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>



{{-- ========================== ACTIVITIES SECTION ========================== --}}
<section id="activities" class="padding-large" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <h3 class="display-3 fw-normal text-center">Island Activities</h3>

        <div class="row mt-5 g-4">

            @foreach ($activities as $activity)
            <div class="col-lg-4">
                <div class="item-card">
                    <img src="{{ asset('storage/'.$activity->image) }}" class="item-img" alt="{{ $activity->name }}">

                    <div class="p-4">
                        <h4>{{ $activity->name }}</h4>
                        <p>{{ $activity->description }}</p>

                        <p class="mb-2"><strong>{{ $activity->price }} / person</strong></p>

                        @auth
                            @php $role = Auth::user()->role; @endphp

                            @if($role === 'customer')
                                <a href="{{ route('activity.book.form', ['activityName' => $activity->name]) }}" class="book-btn">
                                    Book Now
                                </a>

                            @elseif($role === 'admin')
                                <a href="{{ route('admin.activities.index') }}" class="book-btn" style="background:#e7f0ff;">
                                    Modify
                                </a>

                            @elseif($role === 'staff')
                                <span class="disabled-btn">View Only</span>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>



{{-- ========================== SPA SECTION ========================== --}}
<section id="spa" class="padding-large" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <h3 class="display-3 fw-normal text-center">Spa & Wellness</h3>

        <div class="row mt-5 g-4">

            @foreach ($spaItems as $spa)
            <div class="col-lg-4">
                <div class="item-card">
                    <img src="{{ asset('storage/'.$spa->image_path) }}" class="item-img" alt="{{ $spa->name }}">

                    <div class="p-4">
                        <h4>{{ $spa->name }}</h4>
                        <p>{{ $spa->description }}</p>

                        <p class="mb-2"><strong>${{ $spa->price }} / person</strong></p>

                        @auth
                            @php $role = Auth::user()->role; @endphp

                            @if($role === 'customer')
                                <a href="{{ route('spa.book.form', ['treatmentName' => $spa->name]) }}" class="book-btn">
                                    Book Now
                                </a>

                            @elseif($role === 'admin')
                                <a href="{{ route('admin.spa.index') }}" class="book-btn" style="background:#e7f0ff;">
                                    Modify
                                </a>

                            @elseif($role === 'staff')
                                <span class="disabled-btn">View Only</span>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

@endsection
