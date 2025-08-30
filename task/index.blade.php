@extends('layout')

@section('content')
<h2>Your Tasks</h2>

<a href="{{ route('tasks.create') }}">➕ Add New Task</a>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px; width: 100%;">
    <tr>
        <th>Title</th>
        <th>Due Date</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    @foreach ($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->due_date }}</td>
            <td>{{ $task->priority }}</td>
            <td>{{ $task->is_completed ? '✅ Completed' : '⏳ Pending' }}</td>
            <td>
                <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit">{{ $task->is_completed ? 'Undo' : 'Mark Complete' }}</button>
                </form>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this task?')">🗑 Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
