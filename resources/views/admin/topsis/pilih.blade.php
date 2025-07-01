@extends('admin.layouts.app')
@section('title', 'Pilih Lowongan')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Pilih Lowongan</h2>
    <ul class="space-y-2">
        @foreach ($lowongans as $lowongan)
            <li>
                <a href="{{ url('/admin/topsis/' . $lowongan->id . '/awal') }}" class="text-blue-600 hover:underline">
                    🔍 {{ $lowongan->judul }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
