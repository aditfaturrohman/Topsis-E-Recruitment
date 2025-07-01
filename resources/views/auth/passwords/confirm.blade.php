@extends('layouts.guest')

@section('content')
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 py-6 sm:px-6 lg:px-8">
        <div class="w-full sm:max-w-md space-y-8 bg-white p-8 shadow-lg rounded-lg">
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">{{ __('Confirm Password') }}</h2>

            <div class="mt-6 text-center text-gray-600">
                <p>{{ __('Please confirm your password before continuing.') }}</p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Button -->
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                        {{ __('Confirm Password') }}
                    </button>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-center mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
