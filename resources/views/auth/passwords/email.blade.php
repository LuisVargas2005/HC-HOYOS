@extends('layouts.app')

@section('content')
<div class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Olvidaste tu contraseña? Ingresa tu email y te enviaremos un enlace para restablecerla.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" 
                        :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="bg-green-600 hover:bg-green-700">
                    {{ __('Enviar enlace de recuperación') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
@endsection