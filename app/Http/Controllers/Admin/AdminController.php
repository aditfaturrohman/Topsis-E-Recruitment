<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Lamaran;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalLowongan' => Lowongan::count(),
            'totalLamaran' => Lamaran::count(),
            'lamaranPending' => Lamaran::where('status', 'pending')->count(),
            'lamaranDiproses' => Lamaran::where('status', 'diproses')->count(),
            'lamaranLolos' => Lamaran::where('status', 'lolos')->count(),
            'lamaranDitolak' => Lamaran::where('status', 'ditolak')->count(),
        ]);
    }
}
