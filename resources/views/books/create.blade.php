@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Book</h2>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div>
            <label for="book_type_id">Book Type</label>
            <select name="book_type_id" id="book_type_id"  class="form-control" >
                @foreach ($bookTypes as $bookType)
                    <option value="{{ $bookType->id }}">{{ $bookType->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required>
        </div>
        <div>
            <label for="author">Author</label>
            <input type="text" name="author" id="author" value="{{ old('author') }}" class="form-control"required>
        </div>
        <div>
            <label for="publisher">Publisher</label>
            <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}"  class="form-control">
        </div>
        <div>
            <label for="year">Year</label>
            <input type="number" name="year" id="year" value="{{ old('year') }}" required   class="form-control">
        </div>
        <div>
            <button type="submit"   class="btn btn-success">Save Book</button>
        </div>
    </form>
</div>
@endsection
