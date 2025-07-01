@extends('pelamar.layouts.app')

@section('title', 'Detail Lowongan')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow max-w-3xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $lowongan['judul'] }}</h1>
        <p class="text-gray-600 text-sm mb-4">Lokasi: {{ $lowongan['lokasi'] }}</p>
        <p class="text-gray-700 mb-4">{{ $lowongan['deskripsi'] }}</p>
        <p class="text-sm text-gray-500 mb-6">Batas Lamaran: {{ $lowongan['batas_lamaran'] }}</p>

        <a href="{{ url('/lamar/' . $lowongan['id']) }}"
            class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Lamar Sekarang
        </a>
    </div>
@endsection
