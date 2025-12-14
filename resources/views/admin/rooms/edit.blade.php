@extends('layouts.main')

@section('content')
<div class="container">

    <h1 class="mb-4">Edit Room</h1>

    <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Room Name</label>
            <input type="text" name="name" value="{{ $room->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (per night)</label>
            <input type="number" name="price" value="{{ $room->price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" value="{{ $room->capacity }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control" required>{{ $room->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>

            @if($room->image)
                <img src="{{ asset('storage/' . $room->image) }}" width="200" class="mb-3">
            @else
                <p>No image uploaded.</p>
            @endif

            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update Room</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>

    </form>

</div>
@endsection
