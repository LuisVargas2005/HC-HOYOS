@extends('layouts.app')

@section('content')
    <div class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Restablecer Contraseña</h2>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="block">
                    <x-label for="email" value="Correo electrónico" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                  :value="old('email', $request->email)" required autofocus autocomplete="email" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="Nueva contraseña" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                  required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirmar contraseña" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                  name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md
                                       font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700
                                       active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300
                                       disabled:opacity-25 transition ease-in-out duration-150">
                        Restablecer contraseña
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection