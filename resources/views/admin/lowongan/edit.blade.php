@extends('admin.layouts.app')


@section('title', 'Edit Lowongan')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Lowongan</h1>

        <form action="{{ url('/admin/lowongan/' . $lowongan->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Pekerjaan</label>
                <input type="text" name="judul" value="{{ $lowongan->judul }}" required
                    class="w-full border px-4 py-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Pekerjaan</label>
                <textarea name="deskripsi" rows="4" required class="w-full border px-4 py-2 rounded">{{ $lowongan->deskripsi }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ $lowongan->lokasi }}" required
                        class="w-full border px-4 py-2 rounded">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Batas Waktu Lamaran</label>
                    <input type="date" name="batas_lamaran" value="{{ $lowongan->batas_lamaran }}" required
                        class="w-full border px-4 py-2 rounded">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Perbarui
                </button>
                <a href="{{ url('/admin/lowongan') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
@endsection
