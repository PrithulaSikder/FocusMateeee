@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>My Habits</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('habits.create') }}" class="btn btn-primary mb-3">Add Habit</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Habit Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($habits as $habit)
                <tr>
                    <td>{{ $habit->habit_name }}</td>
                    <td>{{ $habit->habit_date }}</td>
                    <td>
                        @if($habit->is_completed)
                            ✅ Completed
                        @else
                            ⏳ Pending
                        @endif
                    </td>
                    <td>
                        @if(!$habit->is_completed)
                            <form action="{{ route('habits.complete', $habit->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">Mark Complete</button>
                            </form>
                        @endif

                        <a href="{{ route('habits.edit', $habit->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('habits.destroy', $habit->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this habit?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No habits found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
