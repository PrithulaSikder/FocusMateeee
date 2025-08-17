@extends('layout')

@section('content')
<div class="container p-4">
    <h2 class="text-xl font-bold mb-4">🌟 Daily Motivation</h2>

    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
        <p class="text-lg font-semibold">“{{ $randomQuote }}”</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">← Back to Dashboard</a>
    </div>
</div>
@endsection
