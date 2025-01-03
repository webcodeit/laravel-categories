@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p><strong>Content:</strong></p>
        <div>
            <p>{{ $post->content }}</p>
        </div>

        <div class="mt-3">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>

            @can('update')
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
            @endcan

            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endcan
        </div>
    </div>
@endsection
