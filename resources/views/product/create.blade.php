@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New product</h1>
        <div class="">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('product.store') }}" method="POST"  enctype="multipart/form-data">
            @csrf

            <div class="form-group">
            <label for="categories">Select Categories:</label>
            <select name="categories[]" id="categories" multiple class="form-control">
                <option value="">select</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            </div>

            <div class="form-group">
                <label for="pro_name">Pro Name</label>
                <input type="text" name="pro_name" id="pro_name" class="form-control @error('pro_name') is-invalid @enderror" value="{{ old('pro_name') }}" required>
                @error('pro_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="pro_price">mobile_number</label>
                <input type="text" name="mobile_number" id="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('pro_price') }}" required>
                @error('pro_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="pro_price">Pro Price</label>
                <input type="text" name="pro_price" id="pro_price" class="form-control @error('pro_price') is-invalid @enderror" value="{{ old('pro_price') }}" required>
                @error('pro_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="pro_image">Pro Image</label>
                <input type="file" name="pro_image" id="pro_image" class="form-control @error('pro_image') is-invalid @enderror" value="{{ old('pro_image') }}" required>
                @error('pro_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group mt-3">
                <label for="pro_desc">Pro Desc</label>
                <textarea name="pro_desc" id="pro_desc" class="form-control @error('pro_desc') is-invalid @enderror" rows="5" required>{{ old('pro_desc') }}</textarea>
                @error('pro_desc')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3">Create</button>
        </form>
        <a href="{{ route('product.index') }}" class="btn btn-primary mt-3">Back</a>
    </div>

<script>
$(document).ready(function() {
    $('#categories').select2({
        // theme: 'bootstrap-5', // Bootstrap 5 theme
        placeholder: "Select categories", // Placeholder text
        allowClear: true // Enable clear button
    });
});
</script>

@endsection
