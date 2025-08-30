@extends('layout')

@section('content')
    <h2>🎥 Motivational Video</h2>
    <p>Here’s your motivational boost for today!</p>

    <div style="text-align: center; margin-top:20px;">
        <iframe width="560" height="315"
                src="{{ $video }}"
                title="Motivational Video"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
        </iframe>
    </div>
@endsection
