@extends('admin.layouts.app')

@section('title', 'Input Nilai Wawancara')

@section('content')
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Input Nilai Wawancara untuk Top 5 Kandidat</h1>

        <form action="{{ url('/admin/topsis/' . $id . '/simpan-wawancara') }}" method="POST">
            @csrf
            <table class="min-w-full bg-white shadow rounded overflow-hidden mb-6">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Nilai Wawancara (1-5)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($top5 as $pelamar)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $pelamar['nama'] }}</td>
                            <td class="px-4 py-2">
                                <input type="number" name="wawancara[{{ $pelamar['id'] }}]" min="1" max="5"
                                    required class="w-24 px-2 py-1 border rounded">

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan Nilai
            </button>
        </form>
    </div>
@endsection
