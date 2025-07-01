@extends('admin.layouts.app')
@section('title', 'Manajemen Lowongan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Lowongan</h1>
        <a href="{{ url('/admin/lowongan/create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
            + Tambah Lowongan
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md animate-fade-in"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Lowongan Aktif</h2> {{-- Diubah sedikit agar lebih deskriptif --}}
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Judul
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Lokasi
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Batas Lamaran
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($lowongans as $index => $lowongan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $lowongan->judul }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $lowongan->lokasi }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $lowongan->batas_lamaran }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3"> {{-- Menggunakan space-x-3 untuk jarak antar tombol aksi --}}
                                <a href="{{ url('/admin/lowongan/' . $lowongan->id . '/edit') }}"
                                    class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Edit</a>

                                <form action="{{ url('/admin/lowongan/' . $lowongan->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus lowongan ini?')"
                                        class="text-red-600 hover:text-red-800 hover:underline font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500 text-sm">Belum
                                ada lowongan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
