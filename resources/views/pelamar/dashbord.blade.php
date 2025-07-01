@extends('pelamar.layouts.app')

@section('title', 'Dashboard Pelamar')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Selamat Datang di Dashboard Pelamar</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-gray-600 text-sm">Lowongan Aktif</h2>
                <p class="text-2xl font-semibold text-blue-600">{{ $jumlahLowongan }}</p>
            </div>

            <div class="bg-white shadow rounded p-4">
                <h2 class="text-gray-600 text-sm">Lamaran Dikirim</h2>
                <p class="text-2xl font-semibold text-green-600">{{ $lamaran ? 1 : 0 }}</p>
            </div>

            <div class="bg-white shadow rounded p-4">
                <h2 class="text-gray-600 text-sm">Status Lamaran</h2>
                <p class="text-lg font-medium">
                    {{ $lamaran ? ucfirst($lamaran->status) : 'Belum Ada' }}
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Akses Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ url('/lowongan') }}"
                    class="block p-4 bg-blue-100 text-blue-700 rounded text-center hover:bg-blue-200">Lihat Lowongan</a>
                <a href="{{ url('/lamaran') }}"
                    class="block p-4 bg-green-100 text-green-700 rounded text-center hover:bg-green-200">Lamaran Saya</a>
                <a href="{{ url('/profil') }}"
                    class="block p-4 bg-yellow-100 text-yellow-700 rounded text-center hover:bg-yellow-200">Edit Profil</a>
            </div>
        </div>
    </div>
@endsection
