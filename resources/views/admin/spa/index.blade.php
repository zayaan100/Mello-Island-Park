@extends('layouts.main')

@section('content')

<div class="container py-4">

    <h1 class="mb-4" style="font-weight:600;">Spa Services</h1>

    {{-- Mellow Theme Add Button --}}
    <a href="{{ route('admin.spa.create') }}" class="mellow-btn mb-4">
        + Add Spa Service
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
            text-decoration: none;
            transition: 0.25s ease;
            display: inline-block;
        }
        .mellow-btn:hover {
            background: #e8dfd7;
        }

        /* GRID LAYOUT */
        .spa-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
            gap: 28px;
            padding-bottom: 40px;
        }

        /* SPA CARD */
        .spa-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #f0e8e2;
            box-shadow: 0px 8px 22px rgba(0,0,0,0.07);
            transition: 0.28s ease;
        }
        .spa-card:hover {
            transform: translateY(-6px);
            box-shadow: 0px 12px 30px rgba(0,0,0,0.11);
        }

        .spa-card img {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }

        /* BODY */
        .spa-body {
            padding: 20px;
        }

        .spa-body h4 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #1f1f1f;
        }

        .spa-desc {
            font-size: 15px;
            color: #555;
            margin-bottom: 10px;
            line-height: 1.45;
        }

        .spa-price {
            font-weight: 600;
            font-size: 17px;
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



    {{-- If empty --}}
    @if($spaServices->isEmpty())
        <p>No spa services available.</p>
    @else



    {{-- SPA GRID --}}
    <div class="spa-grid">

        @foreach($spaServices as $spa)
            <div class="spa-card">

                {{-- IMAGE --}}
                @if($spa->image_path)
                    <img src="{{ asset('storage/' . $spa->image_path) }}" alt="{{ $spa->name }}">
                @else
                    <img src="https://via.placeholder.com/330x230?text=No+Image" alt="No Image">
                @endif

                <div class="spa-body">

                    <h4>{{ $spa->name }}</h4>

                    <p class="spa-desc">{{ $spa->description }}</p>

                    <div class="spa-price">${{ $spa->price }}</div>

                    {{-- DELETE BUTTON --}}
                    <form method="POST" action="{{ route('admin.spa.destroy', $spa->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('Delete this spa service?')">
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
