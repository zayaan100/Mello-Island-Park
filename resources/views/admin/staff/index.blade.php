@extends('layouts.main')

@section('content')
<div class="container">

    <h2 class="mb-4">Staff Members</h2>

    {{-- Add Staff button --}}
    <a href="{{ route('admin.staff.create') }}" class="btn btn-primary mb-3">
        Add Staff
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Nationality</th>
                <th style="width: 120px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staff as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->dob }}</td>
                    <td>{{ $member->gender }}</td>
                    <td>{{ $member->nationality }}</td>
                    <td>
                        {{-- Delete staff --}}
                        <form action="{{ route('admin.staff.destroy', $member->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this staff member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
