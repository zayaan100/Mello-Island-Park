@extends('layouts.main')

@section('content')

<div class="container py-4">

    <h1 class="mb-4" style="font-weight:600;">Activities</h1>

    {{-- MELLOW THEME BUTTON --}}
    <a href="{{ route('admin.activities.create') }}" class="mellow-btn mb-4">
        + Add Activity
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <style>
        /* MELLOW BUTTON */
        .mellow-btn {
            background: #F5EDE6;
            color: #000;
            padding: 14px 32px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            font-size: 16px;
            display: inline-block;
            text-decoration: none;
            transition: 0.25s ease;
        }
        .mellow-btn:hover {
            background: #e8dfd7;
            color: #000;
        }

        /* GRID LAYOUT */
        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
            gap: 28px;
            padding-bottom: 40px;
        }

        /* CARD */
        .activity-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #f0e8e2;
            box-shadow: 0px 8px 22px rgba(0,0,0,0.07);
            transition: 0.28s ease;
        }
        .activity-card:hover {
            transform: translateY(-6px);
            box-shadow: 0px 12px 28px rgba(0,0,0,0.10);
        }

        /* IMAGE */
        .activity-card img {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }

        /* BODY */
        .activity-body {
            padding: 20px;
        }

        .activity-body h4 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #1f1f1f;
        }

        .activity-desc {
            font-size: 15px;
            color: #555;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .activity-price {
            font-size: 17px;
            font-weight: 600;
            color: #222;
            margin-bottom: 14px;
        }

        /* DELETE BUTTON */
        .delete-btn {
            background: #D96B6B;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: 0.25s ease;
            font-size: 15px;
        }
        .delete-btn:hover {
            background: #c05757;
        }
    </style>

    {{-- NO ACTIVITIES --}}
    @if($activities->isEmpty())
        <p>No activities available.</p>
    @else

    {{-- GRID --}}
    <div class="activities-grid">

        @foreach($activities as $act)
            <div class="activity-card">

                {{-- IMAGE --}}
                @if($act->image)
                    <img src="{{ asset('storage/' . $act->image) }}" alt="{{ $act->name }}">
                @else
                    <img src="https://via.placeholder.com/330x230?text=No+Image" alt="No Image">
                @endif

                <div class="activity-body">
                    <h4>{{ $act->name }}</h4>

                    <p class="activity-desc">{{ $act->description }}</p>

                    <div class="activity-price">${{ $act->price }} <span style="color:#777;">/ person</span></div>

                    {{-- DELETE --}}
                    <form method="POST" action="{{ route('admin.activities.destroy', $act->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn" onclick="return confirm('Delete this activity?')">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        @endforeach

    </div>

    @endif

</div>

@endsection
