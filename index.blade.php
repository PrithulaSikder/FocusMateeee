@extends('layout')

@section('content')
    <h2>Daily Mood Tracker</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    {{-- Create or update today's mood --}}
    @if(!$todaysMood)
        <form action="{{ route('moods.store') }}" method="POST">
            @csrf
            <label>Select your mood for today:</label><br><br>
            <button type="submit" name="mood" value="happy">😊 Happy</button>
            <button type="submit" name="mood" value="neutral">😐 Neutral</button>
            <button type="submit" name="mood" value="sad">😢 Sad</button>
            <button type="submit" name="mood" value="anxious">😰 Anxious</button>
            <button type="submit" name="mood" value="angry">😠 Angry</button>
        </form>
    @else
        <p><strong>Today's mood:</strong> {{ ucfirst($todaysMood->mood) }}</p>

        <form action="{{ route('moods.update', $todaysMood->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label>Update today's mood:</label><br><br>
            <button type="submit" name="mood" value="happy" {{ $todaysMood->mood == 'happy' ? 'disabled' : '' }}>😊 Happy</button>
            <button type="submit" name="mood" value="neutral" {{ $todaysMood->mood == 'neutral' ? 'disabled' : '' }}>😐 Neutral</button>
            <button type="submit" name="mood" value="sad" {{ $todaysMood->mood == 'sad' ? 'disabled' : '' }}>😢 Sad</button>
            <button type="submit" name="mood" value="anxious" {{ $todaysMood->mood == 'anxious' ? 'disabled' : '' }}>😰 Anxious</button>
            <button type="submit" name="mood" value="angry" {{ $todaysMood->mood == 'angry' ? 'disabled' : '' }}>😠 Angry</button>
        </form>
    @endif

    {{-- Mood history table --}}
    <h3>Mood History</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Date</th>
                <th>Mood</th>
            </tr>
        </thead>
        <tbody>
            @forelse($moods as $mood)
                <tr>
                    <td>{{ $mood->date }}</td>
                    <td>{{ ucfirst($mood->mood) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No moods recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
