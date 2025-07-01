<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-gray-800">
                Admin Panel
            </div>
            <nav class="flex-1 p-4 space-y-2 text-sm">
                <a href="{{ url('/admin') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin') ? 'bg-gray-800' : '' }}">
                    🏠 Dashboard
                </a>

                <a href="{{ url('/admin/lowongan') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/lowongan*') ? 'bg-gray-800' : '' }}">
                    📋 Manajemen Lowongan
                </a>
                <a href="{{ url('/admin/lamaran') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/lamaran*') ? 'bg-gray-800' : '' }}">
                    🧾 Data Lamaran
                </a>
                <a href="{{ url('/admin/topsis') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->is('admin/topsis*') ? 'bg-gray-800' : '' }}">
                    📊 Perangkingan TOPSIS
                </a>

                {{-- Tambahkan menu lain kalau nanti ada --}}
            </nav>

            {{-- Logout Button --}}
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

            <div class="p-4 text-sm border border-gray-800">© 2025</div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col">
            {{-- Navbar --}}
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">@yield('title')</h1>
                <span class="text-gray-600">Halo, Admin 👨‍💼</span>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>
