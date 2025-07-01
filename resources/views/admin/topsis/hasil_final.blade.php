@extends('admin.layouts.app')

@section('title', 'Hasil Seleksi Akhir')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Hasil Seleksi Akhir Berdasarkan Semua Kriteria</h2>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Ranking Pelamar Final</h3>
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
                            Nama Pelamar
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Skor Preferensi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($ranking as $index => $r)
                        {{-- Menggunakan forelse untuk penanganan kosong --}}
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $r['nama'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                {{ number_format($r['preferensi'], 4) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-gray-500 text-sm">Belum
                                ada data ranking final.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
