@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">📋 Total Lowongan</h2>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalLowongan }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">🧾 Total Lamaran</h2>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalLamaran }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">🕒 Lamaran Pending</h2>
            <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $lamaranPending }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">⚙️ Diproses</h2>
            <p class="text-3xl font-bold text-indigo-500 mt-2">{{ $lamaranDiproses }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">✅ Lolos</h2>
            <p class="text-3xl font-bold text-green-500 mt-2">{{ $lamaranLolos }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">❌ Ditolak</h2>
            <p class="text-3xl font-bold text-red-500 mt-2">{{ $lamaranDitolak }}</p>
        </div>
    </div>
@endsection
