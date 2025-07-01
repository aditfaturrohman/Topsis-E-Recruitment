<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Coffee Kane Recruitment') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Konfigurasi Tailwind untuk mengenali font Poppins jika belum di-load di app.css lokal Anda
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        Poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Pastikan body menggunakan font Poppins */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            /* Warna latar belakang default, setara dengan Tailwind bg-gray-100 */
        }
    </style>
</head>

<body class="font-[Poppins] antialiased">
    <div id="app">
        {{-- Navbar --}}
        <nav class="bg-white shadow-md py-3 px-6 md:px-20">
            <div class="container mx-auto flex justify-between items-center">
                <a class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300"
                    href="{{ url('/') }}">
                    {{ config('app.name', 'Coffee Kane') }}
                </a>

                <div class="flex items-center space-x-4">
                    @guest
                        <a class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 transition-colors duration-300"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        {{-- Dropdown untuk User yang Login --}}
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 focus:outline-none">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <a href="{{ url('/dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                    tabindex="-1" id="user-menu-item-0">
                                    Dashboard
                                </a>
                                {{-- Jika ada halaman profil atau setting --}}
                                {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">
                                    Profile
                                </a> --}}
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                    tabindex="-1" id="user-menu-item-2">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="py-4"> {{-- Padding top/bottom untuk konten utama --}}
            @yield('content') {{-- Ini adalah tempat konten spesifik halaman akan di-render --}}
        </main>
    </div>
</body>

</html>
