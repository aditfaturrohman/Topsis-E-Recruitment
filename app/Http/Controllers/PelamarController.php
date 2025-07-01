<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Lowongan; 


class PelamarController extends Controller
{
    public function dashboard()
    {
    $jumlahLowongan = \App\Models\Lowongan::whereDate('batas_lamaran', '>=', now())->count();
    $lamaranSaya = \App\Models\Lamaran::orderBy('created_at', 'desc')->first();

    return view('pelamar.dashboard', [
        'jumlahLowongan' => $jumlahLowongan,
        'lamaran' => $lamaranSaya
    ]);
    }
    
    public function lamaranSaya()
    {
        // Ambil data lamaran berdasarkan pelamar (menggunakan user yang login, di sini diasumsikan pelamar 1)
        $lamaranSaya = Lamaran::where('nama', 'Dewi')->get(); // Sementara ini pakai nama Dewi untuk testing

        return view('pelamar.lamaran.index', compact('lamaranSaya'));
    }   

    
    public function daftarLowongan()
    {
        $lowongans = Lowongan::whereDate('batas_lamaran', '>=', now())
            ->orderBy('batas_lamaran', 'asc')
            ->get();

        return view('pelamar.lowongan.index', compact('lowongans'));
    }   


    public function detailLowongan($id)
    {
    $lowongan = Lowongan::findOrFail($id);
    return view('pelamar.lowongan.detail', compact('lowongan'));
    }


    public function formLamar($id)
    {
        return view('pelamar.lamaran.form', ['lowongan_id' => $id]);
    }
    
   public function kirimLamaran(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'ttl' => 'required|date',
        'pendidikan' => 'required',
        'umur' => 'required|integer|min:17',
        'pengalaman' => 'required|integer|min:0',
        'cv' => 'required|mimes:pdf,jpg,png|max:2048',
    ]);

    $cvPath = $request->file('cv')->store('cv', 'public');

    Lamaran::create([
        'lowongan_id' => $id,
        'nama' => $request->nama,
        'ttl' => $request->ttl,
        'pendidikan' => $request->pendidikan,
        'umur' => $request->umur,
        'pengalaman' => $request->pengalaman,
        'cv' => $cvPath,
        'status' => 'pending',
    ]);

    return redirect('/lowongan')->with('success', 'Lamaran berhasil dikirim!');
}

}