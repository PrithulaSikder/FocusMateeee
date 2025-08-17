@extends('layout')

@section('content')
    <style>
        .dashboard {
            max-width: 800px;
            margin: 60px auto;
            padding: 40px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.05);
        }
        h2 {
            font-size: 1.8rem;
            color: #2c3e50;
        }
        .section {
            margin-top: 30px;
        }
        .section h3 {
            color: #2980b9;
            font-size: 1.3rem;
            margin-bottom: 15px;
        }
        ul {
            padding-left: 20px;
            list-style-type: disc;
        }
        .quote {
            font-style: italic;
            color: #888;
            margin-top: 20px;
        }
        .btn-link {
            margin-top: 20px;
            display: inline-block;
            background-color: #f0f0f0;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: #2c3e50;
            font-weight: bold;
        }
    </style>

    <div class="dashboard">
        <h2>Hello, {{ Auth::user()->name }} 👋</h2>
        <p>Welcome back to your FocusMate Dashboard.</p>

        <div class="section">
            <h3>📌 Today's Tasks</h3>
            @if($todaysTasks->count() > 0)
                <ul>
                    @foreach($todaysTasks as $task)
                        <li>{{ $task->title }} ({{ $task->priority }})</li>
                    @endforeach
                </ul>
            @else
                <p>No tasks for today!</p>
            @endif
        </div>

        <div class="section">
            <h3>😊 Today's Mood</h3>
            @if($todaysMood)
                <p>You felt: <strong>{{ ucfirst($todaysMood->mood) }}</strong></p>
            @else
                <p>No mood recorded today.</p>
            @endif
        </div>

        <div class="quote">
            "{{ $quote }}"
        </div>

        <a href="{{ route('weekly.summary') }}" class="btn-link">View Weekly Summary ➜</a>
    </div>
@endsection
