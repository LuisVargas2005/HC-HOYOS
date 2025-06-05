@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 my-8">
        <!-- Filtros y ordenamiento mejorado -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Our Products</h1>
            
            <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-4">
                <div class="relative">
                    <select name="sort" class="appearance-none bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" onchange="this.form.submit()">
                        <option value="">Sort by</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="-price" {{ request('sort') == '-price' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A to Z</option>
                        <option value="-name" {{ request('sort') == '-name' ? 'selected' : '' }}>Name: Z to A</option>
                        <option value="-created_at" {{ request('sort') == '-created_at' ? 'selected' : '' }}>Newest</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        <!-- Products Grid mejorado -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($products as $product)

            @php
                $inWishlist = auth()->check() && auth()->user()->wishlist->contains($product->id);
            @endphp
            
                <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-200 dark:border-gray-700">
                    <!-- Wishlist heart button -->
                    <button class="absolute top-3 right-3 z-10 p-2 bg-white/80 dark:bg-gray-900/80 rounded-full hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors duration-200"
                            onclick="toggleWishlist({{ $product->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                    
                    <!-- Product image container with fixed aspect ratio -->
                    <div class="relative pt-[75%] overflow-hidden">
                        <a href="{{ route('products.show', ['product' => $product]) }}">
                            <img src="{{ $product->image_url }}" 
                                 alt="{{ $product->name }}"
                                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </a>
                    </div>
                    
                    <!-- Product info -->
                    <div class="p-4">
                        <a href="{{ route('products.show', ['product' => $product]) }}" class="block">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 line-clamp-1">{{ $product->name }}</h3>
                        </a>
                        
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-xl font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                            
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center justify-center gap-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-4 py-2 text-sm transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No products found</h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
                </div>
            @endforelse
        </div>

        <!-- Paginación mejorada -->
        @if($products->hasPages())
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Showing <span class="font-medium">{{ $products->firstItem() }}</span> to <span class="font-medium">{{ $products->lastItem() }}</span> of <span class="font-medium">{{ $products->total() }}</span> results
            </div>
            
            <div class="flex items-center gap-1">
                @if($products->onFirstPage())
                    <span class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                        &laquo; Previous
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        &laquo; Previous
                    </a>
                @endif
                
                @foreach($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                    <a href="{{ $url }}" class="px-3 py-1 rounded-md {{ $products->currentPage() == $page ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' }} transition-colors duration-200">
                        {{ $page }}
                    </a>
                @endforeach
                
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        Next &raquo;
                    </a>
                @else
                    <span class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                        Next &raquo;
                    </span>
                @endif
            </div>
        </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    function toggleWishlist(productId) {
    fetch(`/wishlist/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        const heartIcon = document.querySelector(`button[onclick="toggleWishlist(${productId})"] svg`);
        if (data.inWishlist) {
            heartIcon.classList.add('text-red-500', 'fill-current');
            heartIcon.classList.remove('text-gray-400');
        } else {
            heartIcon.classList.remove('text-red-500', 'fill-current');
            heartIcon.classList.add('text-gray-400');
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endpush