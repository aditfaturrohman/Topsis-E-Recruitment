<aside class="w-64 h-screen bg-gray-900 text-white fixed transition-all duration-300 ease-in-out flex flex-col">
    {{-- Tambahkan flex flex-col pada aside --}}

    <div class="p-6 font-bold text-2xl border-b border-gray-700">Pelamar</div>

    <nav class="flex-1 p-4 space-y-2 text-sm"> {{-- flex-1 akan membuat nav memenuhi ruang --}}
        <a href="{{ route('pelamar.dashboard') }}"
            class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('dashboard') ? 'bg-gray-800' : '' }}">
            {{-- Ganti / menjadi dashboard untuk active state --}}
            🏠 Dashboard
        </a>

        <a href="{{ url('/lowongan') }}"
            class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('lowongan') ? 'bg-gray-800' : '' }}">
            📋 Lowongan
        </a>

        <a href="{{ url('/lamaran') }}"
            class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('lamaran*') ? 'bg-gray-800' : '' }}">
            📑 Lamaran Saya
        </a>

        <a href="#"
            class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('profil') ? 'bg-gray-800' : '' }}">
            🔒 Profil
        </a>
    </nav>

    {{-- Groupkan logout dan copyright footer --}}
    <div class="mt-auto">
        <div class="p-4">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="block w-full text-left px-4 py-2 rounded bg-red-800 hover:bg-red-700 transition duration-200 ease-in-out text-sm">
                🚪 Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>

        <div class="p-4 text-sm border-t border-gray-800">© 2025</div>
    </div>
</aside>
