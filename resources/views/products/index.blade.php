@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header con título y controles -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Nuestro Catálogo</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Descubre nuestros productos cuidadosamente seleccionados</p>
            </div>
            
            <!-- Controles de búsqueda y ordenamiento -->
            <div class="w-full md:w-auto space-y-3">
                <!-- Barra de búsqueda -->
                <form method="GET" action="{{ route('products.index') }}" class="relative">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Buscar productos..." 
                               value="{{ request('search') }}"
                               class="w-full md:w-64 pl-4 pr-10 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-800 transition-all duration-200">
                        <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
                
                <!-- Ordenamiento -->
                <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <div class="relative flex-1">
                        <select name="sort" onchange="this.form.submit()" class="w-full appearance-none bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                            <option value="">Ordenar por</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                            <option value="-price" {{ request('sort') == '-price' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nombre: A-Z</option>
                            <option value="-name" {{ request('sort') == '-name' ? 'selected' : '' }}>Nombre: Z-A</option>
                            <option value="-created_at" {{ request('sort') == '-created_at' ? 'selected' : '' }}>Más recientes</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Resultados de búsqueda -->
        @if(request('search'))
        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg border border-blue-200 dark:border-blue-800">
            <p class="text-blue-800 dark:text-blue-200">
                Mostrando resultados para: <span class="font-semibold">"{{ request('search') }}"</span>
                <a href="{{ route('products.index') }}" class="ml-2 text-blue-600 dark:text-blue-300 hover:underline">Limpiar búsqueda</a>
            </p>
        </div>
        @endif

        <!-- Grid de productos -->
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
            @php
                $inWishlist = auth()->check() && auth()->user()->wishlist->contains($product->id);
            @endphp
            
            <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400">
                <!-- Wishlist button -->
                <button class="absolute top-3 right-3 z-10 p-2 bg-white/90 dark:bg-gray-900/90 rounded-full hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors duration-200 shadow-sm"
                        onclick="toggleWishlist({{ $product->id }})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $inWishlist ? 'text-red-500 fill-current' : 'text-gray-400' }}" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $inWishlist ? '1' : '2' }}" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
                
                <!-- Badge de nuevo si el producto es reciente -->
                @if($product->created_at->diffInDays() < 7)
                <span class="absolute top-3 left-3 z-10 bg-blue-500 text-white text-xs font-semibold px-2 py-1 rounded-full">Nuevo</span>
                @endif
                
                <!-- Imagen del producto -->
                <div class="relative pt-[75%] overflow-hidden bg-gray-100 dark:bg-gray-700">
                    <a href="{{ route('products.show', $product) }}">
                        <img src="{{ $product->image_url }}" 
                             alt="{{ $product->name }}"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                </div>
                
                <!-- Información del producto -->
                <div class="p-4">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 line-clamp-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ $product->name }}</h3>
                        @if($product->short_description)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">{{ $product->short_description }}</p>
                        @endif
                    </a>
                    
                    <!-- Rating (si tienes sistema de valoraciones) -->
                    @if($product->rating > 0)
                    <div class="flex items-center mt-2">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($product->rating))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                @elseif($i - 0.5 <= $product->rating)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 15.4V6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4zM22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.64-7.03L22 9.24z"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-gray-300 dark:text-gray-600" viewBox="0 0 24 24">
                                        <path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">{{ number_format($product->rating, 1) }} ({{ $product->reviews_count ?? 0 }})</span>
                    </div>
                    @endif
                    
                    <!-- Precio y botón de compra -->
                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <span class="text-xl font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                            @if($product->compare_at_price > $product->price)
                                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400 line-through">${{ number_format($product->compare_at_price, 2) }}</span>
                                <span class="ml-2 text-xs bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 px-1.5 py-0.5 rounded">
                                    {{ round(100 - ($product->price / $product->compare_at_price * 100)) }}% OFF
                                </span>
                            @endif
                        </div>
                        
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center justify-center gap-1.5 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 py-2 text-sm transition-all duration-200 hover:scale-105 transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="hidden sm:inline">Añadir</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Estado vacío -->
        <div class="text-center py-16">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-4 text-xl font-medium text-gray-900 dark:text-white">No se encontraron productos</h3>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Intenta ajustar tu búsqueda o filtros para encontrar lo que buscas.</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                Ver todos los productos
            </a>
        </div>
        @endif

        <!-- Paginación -->
        @if($products->hasPages())
        <div class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-200 dark:border-gray-700 pt-6">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Mostrando <span class="font-medium">{{ $products->firstItem() }}</span> a <span class="font-medium">{{ $products->lastItem() }}</span> de <span class="font-medium">{{ $products->total() }}</span> productos
            </div>
            
            <div class="flex items-center gap-1">
                @if($products->onFirstPage())
                    <span class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                        &laquo; Anterior
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        &laquo; Anterior
                    </a>
                @endif
                
                @foreach($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                    <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-md {{ $products->currentPage() == $page ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' }} transition-colors duration-200">
                        {{ $page }}
                    </a>
                @endforeach
                
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        Siguiente &raquo;
                    </a>
                @else
                    <span class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                        Siguiente &raquo;
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
            
            // Opcional: Mostrar notificación
            if (data.inWishlist) {
                showNotification('Producto añadido a tu lista de deseos');
            } else {
                showNotification('Producto removido de tu lista de deseos');
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    function showNotification(message) {
        // Implementa tu sistema de notificaciones aquí
        // Puedes usar Toastr, Alpine.js, o un simple alert
        alert(message);
    }
</script>
@endpush