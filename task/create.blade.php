@extends('layout')

@section('content')
<h2>Add Task</h2>

@if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Due Date:</label><br>
    <input type="date" name="due_date" required><br><br>

    <label>Priority:</label><br>
    <select name="priority" required>
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select><br><br>

    <button type="submit">Add Task</button>
</form>
@endsection
