@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>product</h1>
             <!-- Search Form -->
        <form action="{{ route('product.index') }}" method="GET" class="mb-3">
            <div class="input-group col-md-3">
                <input type="text" name="search" class="form-control col-md-3" placeholder="Search products..." value="{{ request()->search }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <a href="{{ route('product.index') }}" class="btn btn-primary mt-3">reset</a>
        </form>
        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Create New product</a>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <table class="table mt-3">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Category</th>
                <th>Products desc</th>
                <th>Actions</th>
            </tr>
        </thead> <tbody>
        @foreach ($products as $product)
                <tr>
                    <td>{{ $product->pro_name }}</td>
                    <td><img src="{{ asset('storage/' . $product->pro_image) }}" alt="Product Image" class="img-thumbnail" width="150"></td>
                    <td>
                    {{ $product->categories->pluck('name')->implode(', ') }}
                      <!-- @foreach($product->categories as $category)
                            {{ $category->name }},
                        @endforeach -->
                    </td>
                    <td>{{ Str::limit($product->pro_desc, 100) }}</td>
                    <td>
                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
