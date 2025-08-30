@extends('layout')

@section('content')
<style>
  .focus-container {
    max-width: 700px;
    margin: 80px auto;
    padding: 36px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    text-align: center;
    font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  }
  .task-title { font-size: 1.6rem; margin-bottom: 8px; }
  .meta { color: #666; margin-bottom: 20px; }
  .form-inline { display:inline-block; margin:8px; }
  input[type="number"] { width:90px; padding:8px; border-radius:6px; border:1px solid #ddd; }
  button { padding:10px 16px; border-radius:8px; border:none; background:#2d9cdb; color:white; cursor:pointer; }
  .small-link { display:block; margin-top:18px; color:#666; text-decoration:none; }
  .success { color: green; margin-bottom:12px; }
</style>

<div class="focus-container">
    <h2>🎯 Focus Mode</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($focusTask)
        <div class="task-title">{{ $focusTask->title }}</div>
        <div class="meta">Priority: <strong>{{ $focusTask->priority }}</strong> · Due: {{ $focusTask->due_date }}</div>

        @if($focusTask->pomodoro_start && $focusTask->pomodoro_duration)
            <p>Pomodoro started at: <strong>{{ \Carbon\Carbon::createFromFormat('H:i:s', $focusTask->pomodoro_start)->format('H:i') }}</strong></p>
            <p>Duration: <strong>{{ $focusTask->pomodoro_duration }} minutes</strong></p>
            <p>Expected end time:
                <strong>
                {{
                    \Carbon\Carbon::createFromFormat('H:i:s', $focusTask->pomodoro_start)
                        ->addMinutes($focusTask->pomodoro_duration)
                        ->format('H:i')
                }}
                </strong>
            </p>
            <p class="small">When your session ends, mark the task complete (button below).</p>
        @else
            <form class="form-inline" action="{{ route('focus.start', $focusTask) }}" method="POST">
                @csrf
                <label for="duration">Set duration (minutes):</label>
                <input type="number" id="duration" name="duration" min="1" max="480" value="25" required>
                <button type="submit">▶ Start</button>
            </form>
        @endif

        <div style="margin-top:18px;">
            <form action="{{ route('focus.complete', $focusTask) }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit">✅ Mark Complete</button>
            </form>

            <form action="{{ route('focus.set', $focusTask) }}" method="POST" style="display:inline-block; margin-left:10px;">
                @csrf
                <button type="submit">🔁 Set as Focus</button>
            </form>
        </div>

    @else
        <p>No active task. Create one or go to your <a href="{{ url('/tasks') }}">Tasks</a> and set one as focus.</p>
    @endif

    <a class="small-link" href="{{ route('dashboard') }}">← Back to Dashboard</a>
</div>
@endsection
