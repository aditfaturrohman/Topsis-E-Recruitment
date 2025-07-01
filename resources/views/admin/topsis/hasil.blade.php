@extends('admin.layouts.app')
@section('title', 'Hasil Perangkingan')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Hasil Ranking Pelamar</h2>
    <table class="w-full bg-white border rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Pendidikan</th>
                <th class="px-4 py-2">Umur</th>
                <th class="px-4 py-2">Pengalaman</th>
                <th class="px-4 py-2">Skor Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ranking as $r)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $r['nama'] }}</td>
                    <td class="px-4 py-2">{{ $r['pendidikan'] }}</td>
                    <td class="px-4 py-2">{{ $r['umur'] }}</td>
                    <td class="px-4 py-2">{{ $r['pengalaman'] }}</td>
                    <td class="px-4 py-2 font-semibold text-blue-600">{{ number_format($r['preferensi'], 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
