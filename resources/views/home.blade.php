@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section con imagen de fondo y diseño innovador -->
<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <div class="pt-10 px-4 sm:px-6 lg:px-8">
                <div class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            Tecnología y Soluciones <span class="block text-blue-600">a tu Alcance</span>
                        </h1>
                        <h2 class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            "E-commerce tecnológico, reparaciones programadas y gestión legal profesional, simplificada para ti."
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt="Dispositivos electrónicos premium">
    </div>
</div>

    <!-- Featured Categories -->
        <div class="container mx-auto px-4 py-12">
            <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Explora Nuestras Categorías</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Celulares -->
                <a href="{{ route('products.index', ['category' => 'electronics']) }}" class="group block">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl">
                        <div class="h-48 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center relative">
                            <img src="https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                                alt="Celulares" 
                                class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                            <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-20 transition-all"></div>
                        </div>
                        <div class="p-5 text-center">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Celulares</h3>
                            <p class="text-sm text-gray-500">Encuentra los mejores modelos en nuestro catálogo</p>
                        </div>
                    </div>
                </a>

                <!-- Computadores -->
                <a href="{{ route('products.index', ['category' => 'computers']) }}" class="group block">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl">
                        <div class="h-48 bg-gradient-to-br from-purple-50 to-purple-100 flex items-center justify-center relative">
                            <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                                alt="Computadores" 
                                class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                            <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-20 transition-all"></div>
                        </div>
                        <div class="p-5 text-center">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Computadores</h3>
                            <p class="text-sm text-gray-500">Descubre nuestra selección de equipos</p>
                        </div>
                    </div>
                </a>

                <!-- Accesorios -->
                <a href="{{ route('products.index', ['category' => 'accessories']) }}" class="group block">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl">
                        <div class="h-48 bg-gradient-to-br from-amber-50 to-amber-100 flex items-center justify-center relative">
                            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                                alt="Accesorios" 
                                class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                            <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-20 transition-all"></div>
                        </div>
                        <div class="p-5 text-center">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Accesorios</h3>
                            <p class="text-sm text-gray-500">Complementos para tus dispositivos</p>
                        </div>
                    </div>
                </a>

                <!-- Otros -->
                <a href="{{ route('products.index', ['category' => 'others']) }}" class="group block">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl">
                        <div class="h-48 bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center relative">
                            <img src="https://images.unsplash.com/photo-1550009158-9ebf69173e03?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                                alt="Otros productos" 
                                class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                            <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-20 transition-all"></div>
                        </div>
                        <div class="p-5 text-center">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Otros Productos</h3>
                            <p class="text-sm text-gray-500">Más artículos que te pueden interesar</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        {{-- contendor de funciones --}}

        <h1 class="text-center text-3xl font-bold mt-8">Explora Nuestros Servicios</h1>
            <p class="text-center text-gray-600 mt-4">Descubre lo que tenemos para ofrecerte.</p>

            <div class="container mx-auto py-8 px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Contenedor 1 - Catálogo de Productos -->
                <a href="{{ route('products.index') }}" class="group relative bg-white rounded-xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 h-[400px] block">
                    <!-- Imagen de fondo - Electrónicos -->
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                            alt="Catálogo de electrónicos" 
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    
                    <!-- Contenido 1 Productos-->
                    <div class="p-6 absolute bottom-0 left-0 right-0 bg-gradient-to-t from-white to-white/90">
                        <div class="flex items-center mb-3">
                            <div class="bg-indigo-100 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                </svg>
                            </div>
                        </div>
                        
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Catálogo de Electrónicos</h2>
                        <p class="text-gray-600 mb-4">Descubre los últimos dispositivos electrónicos, smartphones, laptops y accesorios tecnológicos.</p>
                        
                        <div class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800 transition-colors">
                            Ver productos
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Efecto hover -->
                    <div class="absolute inset-0 bg-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                </a>

                <!-- Contenedor 2 - Servicio Técnico -->
                <a href="{{ url('/agendar') }}" class="group relative bg-white rounded-xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 h-[400px] block">
                    
                    <!-- Imagen de fondo - Reparación -->
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                            alt="Servicio técnico" 
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    
                    <div class="p-6 absolute bottom-0 left-0 right-0 bg-gradient-to-t from-white to-white/90">
                        <div class="flex items-center mb-3">
                            <div class="bg-indigo-100 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                        </div>
                        
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Servicio Técnico</h2>
                        <p class="text-gray-600 mb-4">Reparación profesional de dispositivos electrónicos. Diagnóstico rápido y garantía en todos nuestros servicios.</p>
                        
                        <div class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800 transition-colors">
                            Agendar cita
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Efecto hover -->
                    <div class="absolute inset-0 bg-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                </a>
            </div>

    <!-- Testimonios -->
        <div class="container mx-auto px-4 py-16 bg-gray-50 dark:bg-neutral-800">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Lo que dicen nuestros clientes</h2>
                <p class="text-lg text-gray-600 dark:text-neutral-300">Más de 1,000 clientes satisfechos con nuestros productos y servicios de reparación</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonio 1 - Compra -->
                <div class="bg-white dark:bg-neutral-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <div class="h-14 w-14 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-bold text-2xl">J</div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 dark:text-white">Juan Pérez</h3>
                            <p class="text-sm text-gray-500 dark:text-neutral-400">Compra: Smartphone X10</p>
                            <div class="flex mt-1">
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-neutral-300 italic">"Excelente producto y entrega rápida. El teléfono llegó antes de lo esperado y en perfecto estado. La atención al cliente fue muy buena cuando tuve una pequeña duda sobre el funcionamiento."</p>
                    <div class="mt-4 text-sm text-gray-500 dark:text-neutral-400">Hace 2 semanas</div>
                </div>

                <!-- Testimonio 2 - Reparación -->
                <div class="bg-white dark:bg-neutral-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <div class="h-14 w-14 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 font-bold text-2xl">M</div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 dark:text-white">María González</h3>
                            <p class="text-sm text-gray-500 dark:text-neutral-400">Reparación: Portátil</p>
                            <div class="flex mt-1">
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-neutral-300 italic">"Llevé mi portátil a reparar y quedé impresionada con el servicio. Fueron muy transparentes con el diagnóstico y el precio. Lo repararon en menos tiempo del estimado y funciona mejor que cuando era nuevo."</p>
                    <div class="mt-4 text-sm text-gray-500 dark:text-neutral-400">Hace 1 mes</div>
                </div>

                <!-- Testimonio 3 - Atención -->
                <div class="bg-white dark:bg-neutral-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <div class="h-14 w-14 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 font-bold text-2xl">C</div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 dark:text-white">Carlos Rodríguez</h3>
                            <p class="text-sm text-gray-500 dark:text-neutral-400">Cliente frecuente</p>
                            <div class="flex mt-1">
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                                <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-neutral-300 italic">"He comprado varios productos y usado su servicio de reparación en múltiples ocasiones. Siempre recibo un trato profesional y amable. Los precios son justos y la calidad del servicio es consistente. ¡Mi tienda de tecnología de confianza!"</p>
                    <div class="mt-4 text-sm text-gray-500 dark:text-neutral-400">Cliente desde 2020</div>
                </div>
            </div>

            <!-- Botón para ver más testimonios -->
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                    Ver más testimonios
                    <svg class="ml-3 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
@endsection
