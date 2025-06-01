@extends('layouts.app')

@section('content')
<div class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Restablecer Contraseña') }}</h2>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <div class="block">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" 
                    :value="old('email', request()->email)" required autofocus />
        </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Nueva Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" 
                          name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" 
                          name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="bg-green-600 hover:bg-green-700">
                    {{ __('Restablecer Contraseña') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
@endsection