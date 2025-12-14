@extends('layouts.main')

@section('content')

<div class="container py-4">

    <h1 class="mb-4" style="font-weight:600;">Manage Rooms</h1>

    {{-- Themed Button --}}
    <a href="{{ route('admin.rooms.create') }}" class="mellow-btn mb-4">
        + Add New Room
    </a>

    <style>
        /* MAIN MELLOW BUTTON */
        .mellow-btn {
            background: #F5EDE6;
            color: #000;
            padding: 14px 32px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            transition: 0.25s ease;
            display: inline-block;
        }
        .mellow-btn:hover {
            background: #e8dfd7;
        }

        /* GRID LAYOUT (more modern + centered) */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 28px;
            padding-bottom: 40px;
        }

        /* ROOM CARD */
        .room-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 8px 22px rgba(0, 0, 0, 0.07);
            transition: 0.28s ease;
            border: 1px solid #f0e8e2;
        }

        .room-card:hover {
            transform: translateY(-6px);
            box-shadow: 0px 12px 28px rgba(0, 0, 0, 0.10);
        }

        /* IMAGE */
        .room-card img {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }

        /* CARD BODY */
        .room-card-body {
            padding: 20px;
        }

        .room-card-body .name {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #1f1f1f;
        }

        .room-description {
            font-size: 15px;
            line-height: 1.5;
            color: #555;
            margin-bottom: 10px;
        }

        .room-price {
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #222;
        }

        .room-meta {
            font-size: 15px;
            color: #666;
            margin-bottom: 12px;
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
            transition: 0.25s;
            font-size: 15px;
        }

        .delete-btn:hover {
            background: #c05757;
        }
    </style>

    {{-- ROOM LIST GRID --}}
    <div class="room-grid">

        @foreach($rooms as $room)
            <div class="room-card">

                {{-- IMAGE --}}
                @if($room->image)
                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}">
                @else
                    <img src="https://via.placeholder.com/320x220?text=No+Image" alt="No Image">
                @endif

                <div class="room-card-body">

                    <div class="name">{{ $room->name }}</div>

                    <div class="room-description">
                        {{ $room->description }}
                    </div>

                    <div class="room-price">${{ $room->price }} <span style="color:#777;">/ night</span></div>

                    <div class="room-meta">Capacity: {{ $room->capacity }} persons</div>

                    {{-- DELETE BUTTON --}}
                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn"
                                onclick="return confirm('Delete this room?')">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        @endforeach

    </div>

</div>

@endsection
