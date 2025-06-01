@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Wishlist</h1>
    
    @if(session('share_url'))
        <div class="alert alert-success">
            Your wishlist share URL: <a href="{{ session('share_url') }}">{{ session('share_url') }}</a>
        </div>
    @endif
    
    <form action="{{ route('wishlist.share') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mb-3">Share Wishlist</button>
    </form>
    
    @if($products->isEmpty())
        <p>Your wishlist is empty.</p>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ $product->image_url ?? '/images/placeholder.png' }}" 
                             alt="{{ $product->name }}" 
                             class="card-img-top">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="card-text mt-auto"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View Details</a>
                                <form action="{{ route('wishlist.remove', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection