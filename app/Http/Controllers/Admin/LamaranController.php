<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Lowongan;

class LamaranController extends Controller
{
    public function index()
    {
        $lamarans = Lamaran::with('lowongan')->latest()->get();
        return view('admin.lamaran.index', compact('lamarans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required']);
        $lamaran = Lamaran::findOrFail($id);
        $lamaran->status = $request->status;
        $lamaran->save();

        return redirect('/admin/lamaran')->with('success', 'Status lamaran diperbarui.');
    }
}
