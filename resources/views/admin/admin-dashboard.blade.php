@extends('layouts.main')

@section('content')
<div class="container">

    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="list-group">

        <a href="{{ route('admin.staff.index') }}" class="list-group-item list-group-item-action">
            Manage Staff
        </a>

        <a href="{{ route('admin.rooms.index') }}" class="list-group-item list-group-item-action">
            Manage Rooms
        </a>

        <a href="{{ route('admin.activities.index') }}" class="list-group-item list-group-item-action">
            Manage Activities
        </a>

        <a href="{{ route('admin.spa.index') }}" class="list-group-item list-group-item-action">
            Manage Spa & Wellness
        </a>

        <!-- ✅ NEW: Ferry ID Management -->
        <a href="{{ route('admin.ferry.index') }}" class="list-group-item list-group-item-action">
            Generate Ferry ID
        </a>

    </div>

</div>
@endsection
