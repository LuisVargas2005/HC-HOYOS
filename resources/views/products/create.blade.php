@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Product</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="sku">SKU:</label>
            <input type="text" class="form-control" id="sku" name="sku" required>
            @error('sku')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="short_description">Descripción corta:</label>
            <input type="text" class="form-control" id="short_description" name="short_description">
            @error('short_description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="long_description">Descripción larga:</label>
            <textarea class="form-control" id="long_description" name="long_description"></textarea>
            @error('long_description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Precio:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inventory_count">Cantidad en stock:</label>
            <input type="number" class="form-control" id="inventory_count" name="inventory_count" required>
            @error('inventory_count')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Categoría:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="featured_image">Imagen principal:</label>
            <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*" required>
            @error('featured_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar producto</button>
    </form>
</div>
@endsection
