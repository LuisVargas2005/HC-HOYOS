@extends('layouts.app')

@section('content')
    <div class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" 
                        required autofocus autocomplete="email" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md 
                                font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 
                                active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 
                                disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection