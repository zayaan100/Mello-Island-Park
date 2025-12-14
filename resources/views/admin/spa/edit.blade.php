@extends('layouts.main')

@section('title', 'Edit Spa Service')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Edit Spa Service</h1>

    <form method="POST" action="{{ route('admin.spa.update', $spa->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ $spa->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ $spa->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input name="price" type="number" step="0.01" class="form-control" value="{{ $spa->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($spa->image)
                <img src="{{ asset('storage/' . $spa->image) }}" width="120">
            @else
                No Image
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Upload New Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Update Spa Service</button>
        <a href="{{ route('admin.spa.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
    