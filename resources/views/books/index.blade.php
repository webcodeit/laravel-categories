@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Books List</h2>
    @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Create New book</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Year</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->bookType->name }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-success">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
