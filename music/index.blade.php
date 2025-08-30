@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-center">🎶 Focus Music / Ambient Sounds</h2>
    <p class="text-gray-600 mb-6 text-center">Choose a sound to help you stay focused and calm.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($sounds as $sound)
            <div class="bg-white rounded-2xl shadow p-4 text-center">
                <h4 class="font-semibold text-lg mb-2">{{ $sound['title'] }}</h4>
                <audio controls loop>
                    
                    <source src="{{ asset($sound['file_path']) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        @endforeach
    </div>
</div>
@endsection
