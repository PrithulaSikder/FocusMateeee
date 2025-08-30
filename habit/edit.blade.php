@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Edit Habit</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                <div>{{ $err }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('habits.update', $habit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Habit Name</label>
            <input type="text" name="habit_name" class="form-control" value="{{ $habit->habit_name }}" required>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="habit_date" class="form-control" value="{{ $habit->habit_date }}" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_completed" class="form-check-input" {{ $habit->is_completed ? 'checked' : '' }}>
            <label class="form-check-label">Completed</label>
        </div>

        <button class="btn btn-primary">Update Habit</button>
        <a href="{{ route('habits.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
