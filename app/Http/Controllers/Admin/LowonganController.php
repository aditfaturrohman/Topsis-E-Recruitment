<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::latest()->get();
        return view('admin.lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        return view('admin.lowongan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'batas_lamaran' => 'required|date'
        ]);

        Lowongan::create($request->all());

        return redirect('/admin/lowongan')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, $id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->update($request->all());

        return redirect('/admin/lowongan')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect('/admin/lowongan')->with('success', 'Lowongan dihapus!');
    }
}
