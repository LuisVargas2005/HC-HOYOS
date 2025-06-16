<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Asegúrate de que 'resources/css/app.css' y 'resources/js/app.js'
         estén configurados en tu vite.config.js y que los estés incluyendo.
         Esto es necesario para que Tailwind CSS funcione. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HCSistemas y Servicios</title>

    <style>
        /* Animación del icono de dropdown */
        .rotate-180 {
            transform: rotate(180deg);
        }
        
        /* Prevenir scroll del body cuando el menú móvil está abierto */
        body.overflow-hidden {
            overflow: hidden;
        }
        
        /* Transiciones suaves para los menús */
        #desktop-dropdown-menu, #mobile-menu, #mobile-dropdown-menu {
            transition: all 0.3s ease-in-out;
        }
        
        /* Ajuste de altura para el menú móvil */
        @media (max-width: 767px) {
            #mobile-menu {
                /* Calula el 100% de la altura del viewport menos la altura del header sticky */
                /* Asegúrate que el "top" coincida con la altura de tu barra de navegación principal */
                top: 96px; /* Posiciona el menú justo debajo del header principal */
                height: calc(100vh - 96px); 
                -webkit-overflow-scrolling: touch; /* Mejora el scroll en iOS */
            }
        }
    </style>
</head>
<body>

<header id="main-header" class="bg-white sticky top-0 z-50 shadow-sm">
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3 text-base md:text-lg">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-6 mb-2 md:mb-0">
                <a href="mailto:Hcsistemasyservicios@gmail.com" class="hover:text-blue-200 flex items-center transition-colors text-sm md:text-base">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Hcsistemasyservicios@gmail.com
                </a>
                <a href="tel:3214956470" class="hover:text-blue-200 flex items-center transition-colors text-sm md:text-base">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    (321) 495 6470
                </a>
            </div>
            <div class="flex items-center space-x-6">
                @guest
                    <a href="{{ route('login') }}" class="hover:text-blue-200 transition-colors text-sm md:text-base">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="hover:text-blue-200 transition-colors text-sm md:text-base">Registrarse</a>
                @else
                    <div class="relative group">
                        <button class="hover:text-blue-200 flex items-center transition-colors text-sm md:text-base">
                            {{ Auth::user()->name }}
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
                            <a href="{{ route('orders.index') }}" class="block px-4 py-3 text-base text-gray-700 hover:bg-gray-100">Mis Pedidos</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-3 text-base text-gray-700 hover:bg-gray-100">Cerrar Sesión</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <h1 class="text-2xl md:text-3xl font-bold text-blue-600 hover:text-blue-800 transition-colors">{{ config('app.name') }}</h1>
            </a>

            <nav class="hidden md:flex items-center space-x-8 text-lg">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium">Inicio</a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Productos</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 font-medium">Contáctanos</a>
                <div class="relative" id="desktop-dropdown-container">
                    <button id="desktop-dropdown-button" class="text-gray-700 hover:text-blue-600 font-medium flex items-center focus:outline-none">
                        Servicios
                        <svg class="ml-1 h-5 w-5 transition-transform" id="desktop-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="desktop-dropdown-menu" class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg py-1 hidden z-10">
                        <a href="{{ url('/agendar') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Agendar</a>
                        <a href="{{ route('products.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Catálogo</a>
                        <a href="{{ route('contact') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Soporte</a>
                    </div>
                </div>
            </nav>

            <div class="flex items-center space-x-6">
                <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-blue-600 relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        @livewire('cart-count')
                    </span>
                </a>
                <button class="md:hidden text-gray-600 hover:text-blue-600 focus:outline-none" id="mobile-menu-button">
                    <svg class="h-6 w-6" id="mobile-menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Asegúrate que el 'top' de este div coincida con la altura de tu header --}}
    <div id="mobile-menu" class="md:hidden hidden bg-white fixed inset-x-0 z-40 overflow-y-auto px-6 transition-all duration-300">
        <div class="flex flex-col space-y-4 py-4">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium py-3 border-b border-gray-100 text-lg">Inicio</a>
            <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600 font-medium py-3 border-b border-gray-100 text-lg">Productos</a>
            <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 font-medium py-3 border-b border-gray-100 text-lg">Contáctanos</a>
            
            <div class="relative">
                <button id="mobile-dropdown-button" class="text-gray-700 hover:text-blue-600 font-medium py-3 border-b border-gray-100 w-full text-left flex justify-between items-center text-lg">
                    Servicios
                    <svg id="mobile-dropdown-icon" class="h-5 w-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="mobile-dropdown-menu" class="hidden pl-4">
                    <a href="{{ url('/agendar') }}" class="block py-3 text-gray-700 hover:text-blue-600 border-b border-gray-100 text-lg">Agendar</a>
                    <a href="{{ route('products.index') }}" class="block py-3 text-gray-700 hover:text-blue-600 border-b border-gray-100 text-lg">Catálogo</a>
                    <a href="{{ route('contact') }}" class="block py-3 text-gray-700 hover:text-blue-600 text-lg">Soporte</a>
                </div>
            </div>
            
            <div class="pt-4 border-t border-gray-200">
                @guest
                    <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-3 text-lg">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-3 text-lg">Registrarse</a>
                @else
                    <div class="text-gray-700 font-medium py-3 text-lg">{{ Auth::user()->name }}</div>
                    <a href="{{ route('profile.show') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-2 pl-4 text-lg">Perfil</a>
                    <a href="{{ route('orders.index') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-2 pl-4 text-lg">Mis Pedidos</a>
                    <a href="{{ route('wishlist.index') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-2 pl-4 text-lg">Lista de Deseos</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left text-gray-700 hover:text-blue-600 font-medium py-2 pl-4 text-lg">Cerrar Sesión</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown de escritorio al click (Servicios)
    const desktopDropdownButton = document.getElementById('desktop-dropdown-button');
    const desktopDropdownMenu = document.getElementById('desktop-dropdown-menu');
    const desktopDropdownIcon = document.getElementById('desktop-dropdown-icon');
    const desktopDropdownContainer = document.getElementById('desktop-dropdown-container');
    
    if (desktopDropdownButton && desktopDropdownMenu) {
        desktopDropdownButton.addEventListener('click', function(e) {
            e.stopPropagation(); // Evita que el clic se propague al documento
            desktopDropdownMenu.classList.toggle('hidden');
            desktopDropdownIcon.classList.toggle('rotate-180');
        });
        
        // Cerrar al hacer click fuera del contenedor del dropdown
        document.addEventListener('click', function(e) {
            if (desktopDropdownMenu.classList.contains('hidden')) return; // Si ya está oculto, no hacer nada

            if (!desktopDropdownContainer.contains(e.target)) {
                desktopDropdownMenu.classList.add('hidden');
                desktopDropdownIcon.classList.remove('rotate-180');
            }
        });
    }

    // Menú móvil toggle (Abrir/Cerrar con el mismo botón)
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuIcon = document.getElementById('mobile-menu-icon'); // Referencia al SVG del icono

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isMenuOpen = !mobileMenu.classList.contains('hidden'); // Verifica si el menú está a punto de abrirse/cerrarse

            mobileMenu.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');

            // Cambiar el icono del botón de menú móvil
            if (isMenuOpen) {
                // Si el menú se va a cerrar (estaba abierto), poner icono de hamburguesa
                mobileMenuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
            } else {
                // Si el menú se va a abrir (estaba cerrado), poner icono de "X"
                mobileMenuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            }

            // Asegurarse de cerrar el dropdown móvil de "Servicios" si el menú principal se cierra
            if (isMenuOpen && mobileDropdownMenu && !mobileDropdownMenu.classList.contains('hidden')) {
                mobileDropdownMenu.classList.add('hidden');
                mobileDropdownIcon.classList.remove('rotate-180');
            }
        });
    }

    // Dropdown móvil (Servicios) toggle
    const mobileDropdownButton = document.getElementById('mobile-dropdown-button');
    const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');
    const mobileDropdownIcon = document.getElementById('mobile-dropdown-icon');
    
    if (mobileDropdownButton && mobileDropdownMenu) {
        mobileDropdownButton.addEventListener('click', function() {
            mobileDropdownMenu.classList.toggle('hidden');
            mobileDropdownIcon.classList.toggle('rotate-180');
        });
    }

    // Cerrar menú móvil al hacer click en un enlace
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Solo cerrar si el menú móvil está visible
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');

                // Revertir el icono del botón de menú móvil a hamburguesa
                if (mobileMenuIcon) {
                    mobileMenuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                }

                // Asegurarse de cerrar el dropdown móvil de "Servicios" si está abierto
                if (mobileDropdownMenu && !mobileDropdownMenu.classList.contains('hidden')) {
                    mobileDropdownMenu.classList.add('hidden');
                    mobileDropdownIcon.classList.remove('rotate-180');
                }
            }
        });
    });

    // Sombra al hacer scroll en el header
    window.addEventListener('scroll', function() {
        const header = document.getElementById('main-header');
        if (window.scrollY > 10) {
            header.classList.add('shadow-md');
            header.classList.remove('shadow-sm'); // Quita la sombra inicial si existe
        } else {
            header.classList.remove('shadow-md');
            header.classList.add('shadow-sm'); // Vuelve a la sombra inicial
        }
    });
});
</script>

</body>
</html>