@extends('layout')

@section('content')
    <h2>Journal History 📖</h2>
    <a href="{{ route('journals.create') }}">Write Today’s Journal</a>

    @foreach ($journals as $journal)
        <div style="margin: 1rem 0; border: 1px solid #ccc; padding: 1rem;">
            <strong>{{ $journal->date }}</strong><br>
            {{ $journal->entry }}
            <br>
            <a href="{{ route('journals.edit', $journal) }}">Edit</a>
            <form action="{{ route('journals.destroy', $journal) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this journal?')">Delete</button>
            </form>
        </div>
    @endforeach
@endsection
