@extends('layouts.guest')

@section('content')
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 py-6 sm:px-6 lg:px-8">
        <div class="w-full sm:max-w-md space-y-8 bg-white p-8 shadow-lg rounded-lg">
            <h2 class="text-3xl font-semibold text-center text-gray-800">{{ __('Verify Your Email Address') }}</h2>

            <div class="mt-6">
                @if (session('resent'))
                    <div class="mb-4 text-sm text-green-600 bg-green-100 border border-green-300 rounded-lg p-3">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p class="text-sm text-gray-600">
                    {{ __('Before proceeding, please check your email for a verification link.') }}</p>
                <p class="text-sm text-gray-600">{{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit"
                        class="text-blue-600 hover:text-blue-800 font-medium">{{ __('click here to request another') }}</button>.
                </form>
                </p>
            </div>
        </div>
    </div>
@endsection
