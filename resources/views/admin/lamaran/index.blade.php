@extends('admin.layouts.app')

@section('title', 'Data Lamaran Masuk')

@section('content')
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md animate-fade-in"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Lamaran Masuk</h2>
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
                            Nama
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Lowongan
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Usia
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Pendidikan
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Pengalaman
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            CV
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($lamarans as $index => $lamaran)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{-- Nama lebih menonjol sedikit --}}
                                {{ $lamaran->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $lamaran->lowongan->judul ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $lamaran->umur }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $lamaran->pendidikan }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $lamaran->pengalaman }} tahun
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($lamaran->cv)
                                    <a href="{{ asset('storage/' . $lamaran->cv) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Lihat CV</a>
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <form action="{{ url('/admin/lamaran/' . $lamaran->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md
                                        {{ $lamaran->status == 'lolos'
                                            ? 'bg-green-100 text-green-800 border-green-300'
                                            : ($lamaran->status == 'ditolak'
                                                ? 'bg-red-100 text-red-800 border-red-300'
                                                : ($lamaran->status == 'diproses'
                                                    ? 'bg-yellow-100 text-yellow-800 border-yellow-300'
                                                    : 'text-gray-700 bg-white')) }}">
                                        <option value="pending" {{ $lamaran->status == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="diproses" {{ $lamaran->status == 'diproses' ? 'selected' : '' }}>
                                            Diproses</option>
                                        <option value="lolos" {{ $lamaran->status == 'lolos' ? 'selected' : '' }}>Lolos
                                        </option>
                                        <option value="ditolak" {{ $lamaran->status == 'ditolak' ? 'selected' : '' }}>
                                            Ditolak</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-center text-gray-500 text-sm">Belum
                                ada lamaran masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
