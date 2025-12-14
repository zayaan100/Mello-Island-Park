@extends('layouts.main')

@section('content')
<div class="container">

    <h2 class="mb-4">Ferry ID Management</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Generate Ferry ID --}}
    <form method="POST" 
          action="{{ auth()->user()->role === 'admin'
                ? route('admin.ferry.generate')
                : route('staff.ferry.generate') }}">
        @csrf

        <button class="btn btn-primary mb-3">
            Generate Ferry ID
        </button>
    </form>

    {{-- Ferry ID List --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ferry ID</th>
                <th>Registered Customers</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ferryIDs as $ferry)
                <tr>
                    <td>{{ $ferry->code }}</td>
                    <td>
                        @if($ferry->users->count())
                            <ul class="mb-0">
                                @foreach($ferry->users as $user)
                                    <li>{{ $user->name }} ({{ $user->email }})</li>
                                @endforeach
                            </ul>
                        @else
                            <em>No customers registered</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
