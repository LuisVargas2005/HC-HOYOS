@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 py-12">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8">

            {{-- Imagen del producto --}}
            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-1/2">
                    <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow">
                </div>

                {{-- Información del producto --}}
                <div class="md:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-700 mb-4">{{ $product->long_description }}</p>

                    @if($product->isFree())
                        <p class="text-lg font-semibold text-green-600">Price: Free</p>
                        <a href="{{ route('download.generate-link', $product->id) }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Download Now</a>
                    
                    @elseif($product->isDonationBased())
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4 space-y-2">
                            @csrf
                            <label class="block font-medium">Support this product (Suggested: ${{ number_format($product->suggested_price, 2) }})</label>
                            <input type="number" name="price" min="{{ $product->minimum_price }}" value="{{ $product->suggested_price }}" step="0.01" class="w-full p-2 border rounded-lg">
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Support & Download</button>
                        </form>

                        @if($product->minimum_price <= 0)
                            <a href="{{ route('download.generate-link', $product->id) }}" class="block mt-2 text-blue-600 hover:underline">Download without donating</a>
                        @endif

                    @else
                        <p class="text-xl font-bold text-gray-800 mb-2">Price: ${{ number_format($product->price, 2) }}</p>
                        
                        @if($product->inventory_count > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-3">
                                @csrf
                                <div class="flex items-center space-x-2">
                                    <label for="quantity" class="font-medium">Quantity:</label>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->inventory_count }}" class="w-24 p-1 border rounded">
                                </div>
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add to Cart</button>
                            

                            </form>
                        @endif
                    @endif

                    {{-- Estado del stock --}}
                    <div class="mt-4">
                        @if($product->inventory_count > 0)
                            <p class="text-green-600 font-semibold">In Stock ({{ $product->inventory_count }})</p>
                        @else
                            <p class="text-red-600 font-semibold">Out of Stock</p>
                        @endif

                        @if($product->inventory_count <= 5 && $product->inventory_count > 0)
                            <p class="text-yellow-500 font-medium">¡Quedan pocos en stock!</p>
                        @endif
                    </div>

                    {{-- Categoría --}}
                    <p class="mt-4 text-gray-600"><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>

                    {{-- Wishlist --}}
                     <div class="mt-4">
                        @livewire('wishlist-toggle', ['product' => $product])
                    </div>
                </div>
            </div>

            {{-- Logs de inventario --}}
            @isset($product->inventoryLogs)
                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-3">Inventory Logs</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border rounded">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Change</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->inventoryLogs as $log)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td class="px-4 py-2">{{ $log->quantity_change }}</td>
                                        <td class="px-4 py-2">{{ $log->reason }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endisset

            {{-- Botón de descarga si el usuario compró --}}
            @if(
                auth()->check() &&
                $product->downloadable &&
                $product->downloadable->count() > 0 &&
                auth()->user()->hasPurchased($product)
            )
                <a href="{{ route('download.generate-link', $product->id) }}" class="mt-6 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Download</a>
            @endif

        </div>
    </div>
</div>
@endsection

@section('meta')
    <meta name="description" content="{{ $product->meta_description ?? $product->short_description }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">
    <meta property="og:title" content="{{ $product->meta_title ?? $product->name }}">
    <meta property="og:description" content="{{ $product->meta_description ?? $product->short_description }}">
    <meta property="og:image" content="{{ asset('/images/placeholder.png') }}">
    <meta property="og:url" content="{{ route('products.show', $product->id) }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection
