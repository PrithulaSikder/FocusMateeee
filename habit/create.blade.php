@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Add Habit</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                <div>{{ $err }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('habits.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Habit Name</label>
            <input type="text" name="habit_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="habit_date" class="form-control" required>
        </div>

        <button class="btn btn-primary">Save Habit</button>
        <a href="{{ route('habits.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
