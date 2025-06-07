<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?? 'en') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="TuNombre o TuEmpresa">
    <meta name="robots" content="index, follow">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', config('app.meta_description'))">
    <meta name="keywords" content="@yield('meta_keywords', 'ecommerce, online shopping')">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', 'Your premier ecommerce destination')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="..." crossorigin="anonymous" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <x-home-navbar />

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 mx-4 mt-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mx-4 mt-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-8 mt-8">
        <!-- Ola decorativa -->
            <div class="wave-top">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" 
                        opacity=".25" 
                        class="fill-current text-[#0056A6]"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" 
                        opacity=".5" 
                        class="fill-current text-[#0056A6]"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" 
                        class="fill-current text-[#0056A6]"></path>
                </svg>
            </div>

            <div class="max-w-7xl mx-auto">
                <!-- Contenido principal -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                    <!-- Logo y descripción -->
                    <div class="flex flex-col items-center md:items-start">
                        <div class="mb-6 flex items-center">
                            <span class="text-2xl font-bold">HC-HOYOS SISTEMAS Y SERVICIOS </span>
                        </div>
                        <p class="text-gray-300 text-sm text-center md:text-left mb-4">
                            "Tu solución integral en tecnología: compra dispositivos de última generación, agenda reparaciones especializadas y accede a asesorías legales y documentos profesionales, todo en un mismo lugar."
                        </p>
                        <div class="flex space-x-6">
                            <a href="#" class="w-12 h-12 bg-gradient-to-tr from-blue-600 to-blue-800 text-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transform hover:scale-110 transition-transform duration-300">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-gradient-to-tr from-pink-500 to-yellow-400 text-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transform hover:scale-110 transition-transform duration-300">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-gradient-to-tr from-green-500 to-green-700 text-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transform hover:scale-110 transition-transform duration-300">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Contacto mejorado -->
                    <div>
                        <h4 class="text-xl font-bold mb-6 pb-2 border-b-2 border-[#0056A6] inline-block">Contacto</h4>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-3 text-[#0056A6]"></i>
                                <span class="text-gray-300">Cra 4 # 5-62, El Agrado, Huila</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone mr-3 text-[#0056A6]"></i>
                                <a href="#" class="text-gray-300 hover:text-white transition-colors">321 495 6470
                                    <span class="text-gray-400"> / </span>311 882 5821
                                </a>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-[#0056A6]"></i>
                                <a href="mailto:support@example.com" 
                                class="text-gray-300 hover:text-white transition-colors duration-200">
                                Hcsistemasyservicios@gmail.com
                                </a>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-clock mr-3 text-[#0056A6]"></i>
                                <span class="text-gray-300">Lun-Vie: 8:00 AM - 7:00 PM</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Mapa interactivo -->
                        <div class="lg:col-span-1">
                            <h4 class="text-xl font-bold mb-6 pb-2 border-b-2 border-[#0056A6] inline-block">Ubicación</h4>
                            <div class="relative overflow-hidden rounded-xl shadow-xl border-2 border-white/20 hover:border-[#fd873a] transition-all duration-500 group">
                                <iframe
                                    title="HC-Hoyos Sistemas y Servicios - Ubicación"
                                    src="https://www.google.com/maps?q=Cra+4+%235-62,+El+Agrado,+Huila&output=embed"
                                    width="100%"
                                    height="220"
                                    allowfullscreen=""
                                    loading="lazy"
                                    class="transition-transform duration-500 group-hover:scale-105"
                                ></iframe>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent pointer-events-none"></div>
                            </div>
                            <a href="https://www.google.com/maps?q=Cra+4+%235-62,+El+Agrado,+Huila" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="mt-3 inline-flex items-center text-sm text-[#ffffff] hover:text-[#fd873a] transition-colors">
                                <i class="fas fa-directions mr-2"></i> Cómo llegar
                            </a>
                        </div>

                    <!-- Newsletter -->
                    <div>
                        <h4 class="text-xl font-bold mb-6 pb-2 border-b-2 border-[#0056A6] inline-block">Newsletter</h4>
                        <p class="text-gray-300 mb-4">
                            Suscríbete para recibir promociones y descuentos especiales.
                        </p>
                        <form class="space-y-3">
                            <input type="email" 
                                placeholder="Tu correo electrónico" 
                                class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 focus:outline-none focus:ring-2 focus:ring-[#fd873a] focus:border-transparent placeholder-gray-400">
                            <button type="submit" 
                                    class="w-full bg-[#0056A6] hover:bg-[#004b91] text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center">
                                Suscribirse <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </form>
                        <div class="mt-6">
                            <h5 class="font-medium mb-3">Métodos de pago</h5>
                            <div class="flex flex-wrap gap-3">
                                <i class="fab fa-cc-visa text-2xl opacity-80 hover:opacity-100 transition-opacity"></i>
                                <i class="fab fa-cc-mastercard text-2xl opacity-80 hover:opacity-100 transition-opacity"></i>
                                <i class="fab fa-cc-amex text-2xl opacity-80 hover:opacity-100 transition-opacity"></i>
                                <i class="fas fa-money-bill-wave text-2xl opacity-80 hover:opacity-100 transition-opacity"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Créditos mejorados -->
                <div class="border-t border-white/20 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-gray-300 text-sm mb-4 md:mb-0">
                            © {{ date('Y') }} <span class="font-semibold">HC SISTEMAS Y SERVICIOS</span> - Proyecto SENA. Todos los derechos reservados.
                        </div>
                        <div class="flex space-x-6">
                            <a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">Términos y condiciones</a>
                            <a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">Política de privacidad</a>
                            <a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">Aviso legal</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

<!-- Estilos para la onda -->
<style>
    .wave-top {
        margin-top: -1px; /* Para que se superponga correctamente */
    }
</style>

    @livewireScripts
    @stack('scripts')
</body>
</html>
