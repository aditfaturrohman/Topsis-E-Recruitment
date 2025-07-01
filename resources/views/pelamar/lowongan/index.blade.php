@extends('pelamar.layouts.app')

@section('title', 'Daftar Lowongan')

@php use Carbon\Carbon; @endphp

@section('content')
    <h1 class="text-2xl font-bold mb-4">Daftar Lowongan Tersedia</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($lowongans as $lowongan)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-800">{{ $lowongan->judul }}</h2>
                <p class="text-sm text-gray-600 mb-1">Lokasi: {{ $lowongan->lokasi }}</p>
                <p class="text-sm text-gray-600 mb-1">Batas:
                    {{ \Carbon\Carbon::parse($lowongan->batas_lamaran)->translatedFormat('d F Y') }}</p>
                <p class="text-gray-700 text-sm mb-3">{{ Str::limit($lowongan->deskripsi, 100) }}</p>
                <a href="{{ url('/lowongan/' . $lowongan->id) }}"
                    class="inline-block text-blue-600 hover:underline font-medium">Lihat Detail</a>
            </div>
        @endforeach

    </div>
@endsection
