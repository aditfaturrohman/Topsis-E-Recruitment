@extends('pelamar.layouts.app')

@section('title', 'Lamaran Saya')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Lamaran Saya</h1>

        @if ($lamaranSaya->isEmpty())
            <p class="text-gray-500">Anda belum melamar pekerjaan apapun.</p>
        @else
            <table class="min-w-full bg-white shadow rounded">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">Lowongan</th>
                        <th class="px-4 py-2">Tanggal Lamaran</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lamaranSaya as $lamaran)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $lamaran->lowongan->judul }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($lamaran->created_at)->format('d F Y') }}</td>
                            <td class="px-4 py-2">{{ ucfirst($lamaran->status) }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ url('/lowongan/' . $lamaran->lowongan_id) }}"
                                    class="text-blue-600 hover:underline">Lihat Lowongan</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
