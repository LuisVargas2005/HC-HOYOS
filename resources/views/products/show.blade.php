@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="flex flex-col md:flex-row">
                {{-- Sección de imagen --}}
                <div class="md:w-1/2 p-8 flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg h-96 w-full">
                        <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    </div>
                </div>

                {{-- Sección de información --}}
                <div class="md:w-1/2 p-8">
                    {{-- Encabezado --}}
                    <div class="border-b border-gray-100 pb-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                                <p class="text-indigo-600 font-medium">{{ $product->category->name ?? 'General' }}</p>
                            </div>
                            @livewire('wishlist-toggle', ['product' => $product])
                        </div>
                        
                        <div class="mt-4 flex items-center">
                            <div class="flex items-center text-amber-400">
                                <!-- Estrellas de valoración (puedes implementar esto dinámicamente) -->
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="ml-1 text-gray-600">4.8</span>
                            </div>
                            <span class="mx-2 text-gray-300">|</span>
                            @if($product->inventory_count > 0)
                                <span class="text-green-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    In Stock
                                </span>
                            @else
                                <span class="text-red-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Out of Stock
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="py-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $product->long_description }}</p>
                    </div>

                    {{-- Precio y acciones --}}
                    <div class="py-6">
                        @if($product->isFree())
                            <div class="bg-blue-50 rounded-xl p-4 mb-6">
                                <p class="text-2xl font-bold text-blue-600">Free Download</p>
                                <p class="text-gray-600 mt-1">Enjoy this product at no cost</p>
                                <a href="{{ route('download.generate-link', $product->id) }}" 
                                   class="mt-4 inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out">
                                    Download Now
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>
                            </div>
                        
                        @elseif($product->isDonationBased())
                            <div class="bg-purple-50 rounded-xl p-4 mb-6">
                                <h4 class="text-lg font-semibold text-purple-800 mb-2">Support the Creator</h4>
                                <p class="text-gray-600 mb-4">Pay what you want (minimum ${{ number_format($product->minimum_price, 2) }})</p>
                                
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="flex items-center space-x-3">
                                        <span class="text-gray-700 font-medium">Your Price:</span>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">$</span>
                                            <input type="number" name="price" min="{{ $product->minimum_price }}" 
                                                   value="{{ $product->suggested_price }}" step="0.01" 
                                                   class="pl-8 w-32 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                        </div>
                                    </div>
                                    <button type="submit" 
                                            class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-purple-600 hover:bg-purple-700 transition duration-150 ease-in-out">
                                        Support & Download
                                    </button>
                                </form>

                                @if($product->minimum_price <= 0)
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('download.generate-link', $product->id) }}" 
                                           class="text-purple-600 hover:text-purple-800 text-sm font-medium transition duration-150 ease-in-out">
                                            Download without donating
                                        </a>
                                    </div>
                                @endif
                            </div>

                        @else
                            <div class="flex items-baseline mb-4">
                                <p class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                                @if($product->inventory_count <= 5 && $product->inventory_count > 0)
                                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        Solo {{ $product->inventory_count }}  Quedan!
                                    </span>
                                @endif
                            </div>

                            @if($product->inventory_count > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150 ease-in-out">
                                        Add to Cart
                                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <button disabled 
                                        class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-gray-400 cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        @endif

                        {{-- Descarga para compradores --}}
                        @if(auth()->check() && $product->downloadable && $product->downloadable->count() > 0 && auth()->user()->hasPurchased($product))
                            <div class="mt-6 text-center">
                                <a href="{{ route('download.generate-link', $product->id) }}" 
                                   class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download Again
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Logs de inventario (solo para administradores) --}}
            @isset($product->inventoryLogs)
                <div class="bg-gray-50 p-8 border-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Inventory History</h3>
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Change</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($product->inventoryLogs as $log)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $log->created_at->format('M d, Y H:i') }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm {{ $log->quantity_change > 0 ? 'text-green-600' : 'text-red-600' }} font-medium">
                                            {{ $log->quantity_change > 0 ? '+' : '' }}{{ $log->quantity_change }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $log->reason }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endisset
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
