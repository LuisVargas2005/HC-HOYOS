<header id="main-header" class="bg-white sticky top-0 z-50 transition-shadow duration-300">
    <!-- Top Bar - Contacto y Acceso -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-2 text-base">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="mailto:support@example.com" class="hover:text-blue-200 flex items-center transition-colors">
                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Hcsistemasyservicios@gmail.com
                </a>
                <a href="#" class="hover:text-blue-200 flex items-center transition-colors">
                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    (321) 495 6470
                </a>
            </div>
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="hover:text-blue-200 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-blue-200 transition-colors">Registrarse</a>
                @else
                    <div class="relative group">
                        <button class="hover:text-blue-200 flex items-center transition-colors">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                            <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Wishlist</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="container mx-auto px-4 py-4 text-base">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <h1 class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition-colors">{{ config('app.name') }}</h1>
            </a>

            <!-- Navegación principal -->
            <nav class="hidden md:flex items-center space-x-8 text-lg">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium">Inicio</a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Productos</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 font-medium">Contactanos</a>
                <div class="relative group" id="dropdown-container">
                    <button id="dropdown-button" class="text-gray-700 hover:text-blue-600 font-medium focus:outline-none">
                        Servicios
                    </button>
                    <div id="dropdown-menu" class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200 z-10">
                        <a href="{{ url('/agendar') }}" class="block px-4 py-2 text-gray-700 hover:text-blue-600 font-medium">Agendar</a>
                        <a href="{{ route('products.index') }}" class="block px-4 py-2 text-gray-700 hover:text-blue-600 font-medium">Catálogo</a>
                        <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-700 hover:text-blue-600 font-medium">Soporte</a>
                    </div>
                </div>
            </nav>

            <!-- Iconos de acción -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('wishlist.index') }}" class="text-gray-600 hover:text-blue-600 relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    @livewire('wishlist-count')
                </a>
                <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-blue-600 relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        @livewire('cart-count')
                    </span>
                </a>
                <button class="md:hidden text-gray-600 hover:text-blue-600" id="mobile-menu-button">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<script>
    // Agregar sombra al hacer scroll
    document.addEventListener('scroll', () => {
        const header = document.getElementById('main-header');
        if (window.scrollY > 10) {
            header.classList.add('shadow-md');
        } else {
            header.classList.remove('shadow-md');
        }
    });
</script>

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const button = document.getElementById('dropdown-button');
    const menu = document.getElementById('dropdown-menu');
    const container = document.getElementById('dropdown-container');

    let isOpen = false;

    button.addEventListener('click', (e) => {
        e.stopPropagation();
        isOpen = !isOpen;
        if (isOpen) {
            menu.classList.remove('opacity-0', 'invisible');
            menu.classList.add('opacity-100', 'visible');
        } else {
            menu.classList.remove('opacity-100', 'visible');
            menu.classList.add('opacity-0', 'invisible');
        }
    });

    // Cierra el menú si haces clic fuera
    document.addEventListener('click', (e) => {
        if (!container.contains(e.target)) {
            isOpen = false;
            menu.classList.remove('opacity-100', 'visible');
            menu.classList.add('opacity-0', 'invisible');
        }
    });
});
</script>