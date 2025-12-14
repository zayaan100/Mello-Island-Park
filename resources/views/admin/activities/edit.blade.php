@extends('layouts.main')

@section('title', 'Edit Activity')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Edit Activity</h1>

    <form method="POST" action="/admin/activities/{{ $activity->id }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ $activity->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $activity->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input name="price" type="number" step="0.01" class="form-control" value="{{ $activity->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image path</label>
            <input name="image_path" class="form-control" value="{{ $activity->image_path }}">
        </div>

        <button class="btn btn-success">Update Activity</button>
        <a href="/admin/activities" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
