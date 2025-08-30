@extends('layout')

@section('content')
    <h2>Edit Journal Entry</h2>

    <form action="{{ route('journals.update', $journal) }}" method="POST">
        @csrf
        @method('PUT')
        <textarea name="entry" rows="8" required>{{ $journal->entry }}</textarea>
        <br>
        <button type="submit">Update</button>
    </form>
@endsection
