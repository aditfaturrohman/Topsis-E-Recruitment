@extends('layouts.guest') {{-- Pastikan ini meng-extend layout guest --}}

@section('content')
    {{-- Ini akan masuk ke dalam $slot di layouts.guest --}}

    {{-- Hapus div ini yang menyebabkan masalah:
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 py-6 sm:px-6 lg:px-8">
        <div class="w-full sm:max-w-md space-y-8 bg-white p-8 shadow-lg rounded-lg">
    --}}

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Reset Password') }}</h2> {{-- Judul h2 --}}

    @if (session('status'))
        <div class="mb-4 text-sm text-green-600 bg-green-100 border border-green-300 rounded-lg p-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email Address') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                autofocus
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>

    {{-- Hapus div penutup yang tidak perlu juga --}}
    {{--
        </div>
    </div>
    --}}
@endsection
