@extends('layout')

@section('content')
    <style>
        .image-page {
            text-align: center;
            margin-top: 40px;
        }
        .image-page img {
            max-width: 70%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .image-page h2 {
            margin-bottom: 20px;
            color: #2980b9;
        }
    </style>

    <div class="image-page">
        <h2>🌟 Inspirational Image of the Day</h2>
        <img src="{{ $imageOfTheDay }}" alt="Inspirational Image">
    </div>
@endsection
