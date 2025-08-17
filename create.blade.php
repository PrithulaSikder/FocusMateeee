@extends('layout')

@section('content')
    <h2>Write Today’s Journal</h2>

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('journals.store') }}" method="POST">
        @csrf
        <textarea name="entry" rows="8" placeholder="Write your thoughts here..." required></textarea>
        <br>
        <button type="submit">Save</button>
    </form>
@endsection
