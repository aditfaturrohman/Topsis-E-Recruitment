@extends('pelamar.layouts.app')

@section('title', 'Formulir Lamaran')

@section('content')
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Formulir Lamaran</h1>

        <form action="{{ url('/lamar/' . $lowongan_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="ttl" required
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                    <select name="pendidikan" required class="w-full px-4 py-2 border rounded-md">
                        <option value="">-- Pilih --</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="S1">S1</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Usia</label>
                    <input type="number" name="umur" min="17" required class="w-full px-4 py-2 border rounded-md">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pengalaman Kerja (dalam tahun)</label>
                <input type="number" name="pengalaman" min="0" max="40" required
                    class="w-full px-4 py-2 border rounded-md">
                <p class="text-xs text-gray-500 mt-1">Contoh: 3 (untuk 3 tahun pengalaman)</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload CV / Portofolio (PDF/JPG/PNG)</label>
                <input type="file" name="cv" accept=".pdf,.jpg,.png"
                    class="w-full px-3 py-2 border rounded-md bg-white">
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                    Kirim Lamaran
                </button>
            </div>
        </form>
    </div>
@endsection
