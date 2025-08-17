@extends('layout')

@section('content')
    <style>
        .summary {
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
            color: #16a085;
            font-size: 1.3rem;
            margin-bottom: 15px;
        }
        ul {
            padding-left: 20px;
            list-style-type: disc;
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

    <div class="summary">
        <h2>📊 Weekly Summary</h2>

        <div class="section">
            <h3>✅ Completed Tasks</h3>
            @if($weeklyCompletedTasks->count() > 0)
                <ul>
                    @foreach($weeklyCompletedTasks as $task)
                        <li>{{ \Carbon\Carbon::parse($task->due_date)->format('D, M j') }} — {{ $task->title }}</li>
                    @endforeach
                </ul>
            @else
                <p>No completed tasks this week.</p>
            @endif
        </div>

        <div class="section">
            <h3>📈 Mood Trend</h3>
            @if($weeklyMoods->count() > 0)
                <ul>
                    @foreach($weeklyMoods as $mood)
                        <li>{{ \Carbon\Carbon::parse($mood->date)->format('D, M j') }} — {{ ucfirst($mood->mood) }}</li>
                    @endforeach
                </ul>
            @else
                <p>No mood data available this week.</p>
            @endif
        </div>

        <a href="{{ route('dashboard') }}" class="btn-link">← Back to Dashboard</a>
    </div>
@endsection
