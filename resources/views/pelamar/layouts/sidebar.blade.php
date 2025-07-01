<aside class="w-64 h-screen bg-gray-900 text-white fixed transition-all duration-300 ease-in-out">
    <div class="p-6 font-bold text-2xl border-b border-gray-700">Pelamar</div>

    <nav class="flex-1 p-4 space-y-2 text-sm">
        <!-- Dashboard -->
        <a href="{{ url('/') }}"
            class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('/') ? 'bg-gray-800' : '' }}">
            🏠 Dashboard
        </a>

        <!-- Lowongan -->
        <a href="{{ url('/lowongan') }}"
            class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('lowongan') ? 'bg-gray-800' : '' }}">
            📋 Lowongan
        </a>

        <!-- Lamaran Saya -->
        <a href="{{ url('/lamaran') }}"
            class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('lamaran*') ? 'bg-gray-800' : '' }}">
            📑 Lamaran Saya
        </a>

        <!-- Profil -->
        <a href="#"
            class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('profil') ? 'bg-gray-800' : '' }}">
            🔒 Profil
        </a>
    </nav>
</aside>
