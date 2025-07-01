@extends('layouts.guest')

@section('content')
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ __('Login') }}</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
            <input id="email" type="email"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg @error('email') border-red-500 @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="text-red-500 text-sm mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
            <input id="password" type="password"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg @error('password') border-red-500 @enderror"
                name="password" required autocomplete="current-password">
            @error('password')
                <span class="text-red-500 text-sm mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox"
                    name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="ml-2 block text-sm text-gray-900" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>

        <div class="mb-4">
            <button type="submit"
                class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                {{ __('Login') }}
            </button>
        </div>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a class="text-blue-600 hover:text-blue-800 font-medium" href="{{ route('register') }}">
                    Register here
                </a>
            </p>
        </div>
    </form>
@endsection
