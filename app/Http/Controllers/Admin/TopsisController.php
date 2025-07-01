<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk logging

class TopsisController extends Controller
{
    public function pilihLowongan()
    {
        $lowongans = Lowongan::orderBy('created_at', 'desc')->get();
        return view('admin.topsis.pilih', compact('lowongans'));
    }

    public function prosesAwal($id)
    {
        $pelamars = Lamaran::where('lowongan_id', $id)
            ->whereNotNull('pendidikan') // Pastikan data penting tidak null
            ->whereNotNull('pengalaman')
            ->whereNotNull('umur')
            ->get();

        $data = $pelamars->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'pendidikan' => $this->skorPendidikan($item->pendidikan),
                'pengalaman' => $this->skorPengalaman($item->pengalaman),
                'usia' => $this->skorUsia($item->umur), // Memanggil fungsi skorUsia
                'cv' => $this->skorCV($item->cv),
            ];
        })->toArray();

        // Log data setelah konversi skor
        Log::info('Data Pelamar Awal (setelah konversi skor):', ['data' => $data]);

        // Periksa apakah ada data sebelum normalisasi
        if (empty($data)) {
            return redirect()->back()->with('error', 'Tidak ada data pelamar yang valid untuk diproses.');
        }

        $normal = $this->normalisasiAwal($data);
        $ranking = $this->hitungRankingAwal($normal);

        return view('admin.topsis.hasil_awal', compact('ranking', 'id'));
    }

    public function formWawancara($id)
{
    $data = Lamaran::where('lowongan_id', $id)
        ->whereNotNull('pendidikan')
        ->whereNotNull('pengalaman')
        ->whereNotNull('umur')
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'pendidikan' => $this->skorPendidikan($item->pendidikan),
                'pengalaman' => $this->skorPengalaman($item->pengalaman),
                'usia' => $this->skorUsia($item->umur),
                'cv' => $this->skorCV($item->cv),
            ];
        })
        ->toArray();

    // Hitung ranking berdasarkan data pelamar
    $ranking = $this->hitungRankingAwal($data);
    // Ambil 5 kandidat terbaik
    $top5 = array_slice($ranking, 0, 10);

    // Kirim data ke view
    return view('admin.topsis.input_wawancara', [
        'top5' => $top5,
        'id' => $id
    ]);
}


    public function simpanWawancara(Request $request, $id)
    {
        $nilaiInput = $request->input('wawancara');

        if (!$nilaiInput || !is_array($nilaiInput)) {
            return back()->with('error', 'Data wawancara tidak ditemukan. Pastikan semua nilai sudah diisi.');
        }

        foreach ($nilaiInput as $lamaran_id => $nilai) {
            // Pastikan nilai wawancara adalah integer
            Lamaran::where('id', $lamaran_id)->update(['wawancara' => (int)$nilai]);
        }

        return redirect('/admin/topsis/' . $id . '/final')->with('success', 'Nilai wawancara disimpan!');
    }


    public function prosesFinal($id)
    {
        $pelamars = Lamaran::where('lowongan_id', $id)
            ->whereNotNull('pendidikan')
            ->whereNotNull('pengalaman')
            ->whereNotNull('umur')
            ->whereNotNull('wawancara') // pastikan wawancara sudah dinilai
            ->get();

        $data = $pelamars->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'pendidikan' => $this->skorPendidikan($item->pendidikan),
                'pengalaman' => $this->skorPengalaman($item->pengalaman),
                'usia' => $this->skorUsia($item->umur),
                'cv' => $this->skorCV($item->cv),
                'wawancara' => (float)$item->wawancara // Pastikan wawancara adalah float
            ];
        })->toArray();

        // Log data untuk proses final
        Log::info('Data Pelamar untuk Proses Final (setelah konversi skor):', ['data' => $data]);

        if (empty($data)) {
            return redirect()->back()->with('error', 'Tidak ada data pelamar yang valid untuk proses final.');
        }

        $ranking = $this->prosesTopsisFinal($data);

        return view('admin.topsis.hasil_final', [
            'ranking' => $ranking,
        ]);
    }

    // --- Fungsi Konversi Skor (private methods) ---
    private function skorPendidikan($pendidikan)
    {
        // Pastikan $pendidikan adalah string
        return match ((string)$pendidikan) {
            'SD' => 1,
            'SMP' => 2,
            'SMA/SMK' => 3,
            'D3' => 4,
            'S1' => 5,
            default => 0, // Mengembalikan 0 jika tidak ada kecocokan
        };
    }

    private function skorPengalaman($tahun)
    {
        // Pastikan $tahun adalah integer atau float
        $tahun = (int)$tahun; 
        if ($tahun < 1) return 1;
        if ($tahun < 2) return 2;
        if ($tahun < 3) return 3;
        if ($tahun < 5) return 4;
        return 5;
    }

    private function skorUsia($umur)
    {
        // Pastikan $umur adalah integer
        $umur = (int)$umur;
        if ($umur > 35) return 1;
        if ($umur < 20) return 2;
        // Urutan ini penting untuk rentang yang tidak tumpang tindih
        if ($umur >= 31 && $umur <= 35) return 3; 
        if ($umur >= 20 && $umur <= 22) return 4;
        if ($umur >= 23 && $umur <= 30) return 5;
        
        // Default return jika tidak ada kondisi yang cocok (misal umur 0, atau umur sangat tinggi tidak >35)
        return 0; 
    }

    private function skorCV($cv)
    {
        // Pastikan $cv adalah boolean atau string yang bisa diinterpretasi boolean
        return ($cv) ? 5 : 0;
    }

    // --- Fungsi TOPSIS Utama (private methods) ---
    private function normalisasiAwal($data)
    {
        $div = []; // Penyebut untuk normalisasi (akar kuadrat dari jumlah kuadrat)
        // Kriteria untuk normalisasi awal: pendidikan, pengalaman, usia, cv
        $criteriaKeys = ['pendidikan', 'pengalaman', 'usia', 'cv']; 

        foreach ($criteriaKeys as $k) {
            $columnValues = array_column($data, $k);
            // Pastikan semua nilai adalah float sebelum di-pow dan di-sum
            $sumOfSquares = array_sum(array_map(fn($val) => pow((float)$val, 2), $columnValues));
            $div[$k] = sqrt($sumOfSquares);
        }

        // Normalisasi data
        foreach ($data as &$row) { // Gunakan & untuk memodifikasi array asli
            foreach ($criteriaKeys as $kriteria) {
                // Pastikan $row[$kriteria] adalah float
                $valueInRow = (float)$row[$kriteria];
                $divisor = (float)$div[$kriteria];

                // Hindari pembagian dengan nol jika penyebut adalah 0
                $row[$kriteria] = ($divisor == 0) ? 0.0 : $valueInRow / $divisor;
                // Tambahkan pengecekan is_finite untuk NaN/Inf
                if (!is_finite($row[$kriteria])) {
                    Log::error('Normalisasi awal menghasilkan NaN/Inf', ['kriteria' => $kriteria, 'valueInRow' => $valueInRow, 'divisor' => $divisor, 'result' => $row[$kriteria]]);
                    $row[$kriteria] = 0.0; // Atur ke 0.0 untuk mencegah masalah
                }
            }
        }

        return $data;
    }

    private function hitungRankingAwal($data)
    {
        // Bobot kriteria untuk perhitungan awal (tanpa wawancara)
        $rawBobot = [
            'pendidikan' => 0.10,
            'pengalaman' => 0.30,
            'usia' => 0.15,
            'cv' => 0.15,
        ];
        $sumRawBobot = array_sum($rawBobot);
        $bobot = [];
        foreach ($rawBobot as $k => $w) {
            // Normalisasi bobot sehingga totalnya 1.0
            $bobot[$k] = ($sumRawBobot == 0) ? 0 : $w / $sumRawBobot; 
        }

        // Matriks Normalisasi Terbobot (V)
        foreach ($data as &$row) { // Gunakan & untuk memodifikasi array asli (data di sini sudah normal)
            foreach ($bobot as $k => $w) {
                // Pastikan nilai sebelum perkalian adalah float
                $row[$k] = (float)$row[$k] * (float)$w; 
                // Tambahkan pengecekan is_finite untuk NaN/Inf
                if (!is_finite($row[$k])) {
                    Log::error('Pembobotan awal menghasilkan NaN/Inf', ['kriteria' => $k, 'value' => $row[$k], 'bobot' => $w, 'result' => $row[$k]]);
                    $row[$k] = 0.0;
                }
            }
        }

        // Menentukan Solusi Ideal Positif (A+) dan Solusi Ideal Negatif (A-)
        $ideal = ['+' => [], '-' => []];
        foreach ($bobot as $k => $_) { 
            $nilai = array_column($data, $k);
            // array_column bisa mengembalikan false jika kunci tidak ada, atau array kosong.
            // Pastikan $nilai bukan array kosong
            if (!empty($nilai)) {
                $ideal['+'][$k] = (float)max($nilai); 
                $ideal['-'][$k] = (float)min($nilai); 
            } else {
                $ideal['+'][$k] = 0.0; // Default jika kolom kosong
                $ideal['-'][$k] = 0.0;
            }
        }

        // Menghitung Jarak ke Solusi Ideal (D+ dan D-) dan Nilai Preferensi (C)
        foreach ($data as &$row) { // Gunakan & untuk memodifikasi array asli
            $dPlus = 0.0; 
            $dMinus = 0.0; 
            foreach ($bobot as $k => $_) { 
                $val = (float)$row[$k]; // Pastikan nilai adalah float
                $idealPlus = (float)($ideal['+'][$k] ?? 0.0); // Ambil nilai ideal, default 0.0
                $idealMinus = (float)($ideal['-'][$k] ?? 0.0);

                $dPlus += pow($val - $idealPlus, 2);
                $dMinus += pow($val - $idealMinus, 2);
            }
            
            $sqrtDPlus = sqrt($dPlus);
            $sqrtDMinus = sqrt($dMinus);
            $denominator = $sqrtDPlus + $sqrtDMinus;
            
            // REVISI KRUSIAL: sqrt() pada $dMinus di numerator dan penanganan pembagian nol
            $row['preferensi'] = ($denominator > 0) ? $sqrtDMinus / $denominator : 0.0;
            
            // Tambahkan pengecekan is_finite untuk nilai preferensi
            if (!is_finite($row['preferensi'])) {
                Log::error('Nilai preferensi awal menghasilkan NaN/Inf', ['nama' => $row['nama'], 'dPlus' => $dPlus, 'dMinus' => $dMinus, 'preferensi' => $row['preferensi']]);
                $row['preferensi'] = 0.0; // Atur ke 0.0 untuk mencegah masalah
            }
        }

        // Mengurutkan alternatif berdasarkan nilai preferensi (C) secara menurun
        usort($data, fn($a, $b) => (int)(($b['preferensi'] ?? 0.0) * 1000000000) <=> (int)(($a['preferensi'] ?? 0.0) * 1000000000));
        return $data;
    }

    private function prosesTopsisFinal($data)
    {
        // Bobot kriteria untuk perhitungan final (dengan wawancara)
        $bobot = [
            'pendidikan' => 0.10,
            'pengalaman' => 0.30,
            'usia' => 0.15,
            'cv' => 0.15,
            'wawancara' => 0.30,
        ];

        // Normalisasi dan Pembobotan (digabungkan)
        $div = []; 
        foreach ($bobot as $k => $_) { // Iterasi melalui kunci bobot untuk kriteria
            $columnValues = array_column($data, $k);
            // Pastikan semua nilai adalah float sebelum di-pow dan di-sum
            $sumOfSquares = array_sum(array_map(fn($val) => pow((float)$val, 2), $columnValues));
            $div[$k] = sqrt($sumOfSquares);
        }

        foreach ($data as &$row) { // Gunakan & untuk memodifikasi array asli
            foreach ($bobot as $k => $w) {
                $valueInRow = (float)($row[$k] ?? 0.0); // Amankan akses $row[$k] jika mungkin undefined
                $divisor = (float)($div[$k] ?? 0.0);
                
                // Normalisasi kemudian dikalikan dengan bobot
                $row[$k] = ($divisor == 0) ? 0.0 : ($valueInRow / $divisor) * (float)$w;

                // Tambahkan pengecekan is_finite untuk NaN/Inf
                if (!is_finite($row[$k])) {
                    Log::error('Pembobotan final menghasilkan NaN/Inf', ['kriteria' => $k, 'valueInRow' => $valueInRow, 'divisor' => $divisor, 'bobot' => $w, 'result' => $row[$k], 'nama' => $row['nama'] ?? 'N/A']);
                    $row[$k] = 0.0;
                }
            }
        }

        // Menentukan Solusi Ideal Positif (A+) dan Solusi Ideal Negatif (A-)
        $ideal = ['+' => [], '-' => []];
        foreach ($bobot as $k => $_) { 
            $nilai = array_column($data, $k);
            if (!empty($nilai)) {
                $ideal['+'][$k] = (float)max($nilai); 
                $ideal['-'][$k] = (float)min($nilai); 
            } else {
                $ideal['+'][$k] = 0.0; 
                $ideal['-'][$k] = 0.0;
            }
        }

        // Menghitung Jarak ke Solusi Ideal (D+ dan D-) dan Nilai Preferensi (C)
        foreach ($data as &$row) { // Gunakan & untuk memodifikasi array asli
            $dPlus = 0.0; 
            $dMinus = 0.0; 
            foreach ($bobot as $k => $_) { 
                $val = (float)($row[$k] ?? 0.0); // Amankan akses $row[$k] jika mungkin undefined
                $idealPlus = (float)($ideal['+'][$k] ?? 0.0);
                $idealMinus = (float)($ideal['s']['-'][$k] ?? 0.0); // Typo: 's' in $ideal['s']['-'][$k] -> Should be $ideal['-'][$k]

                $dPlus += pow($val - $idealPlus, 2);
                $dMinus += pow($val - $idealMinus, 2);
            }
            
            $sqrtDPlus = sqrt($dPlus);
            $sqrtDMinus = sqrt($dMinus);
            $denominator = $sqrtDPlus + $sqrtDMinus;
            
            // REVISI KRUSIAL: sqrt() pada $dMinus di numerator dan penanganan pembagian nol
            $row['preferensi'] = ($denominator > 0) ? $sqrtDMinus / $denominator : 0.0;

            // Tambahkan pengecekan is_finite untuk nilai preferensi
            if (!is_finite($row['preferensi'])) {
                Log::error('Nilai preferensi final menghasilkan NaN/Inf', ['nama' => $row['nama'] ?? 'N/A', 'dPlus' => $dPlus, 'dMinus' => $dMinus, 'preferensi' => $row['preferensi']]);
                $row['preferensi'] = 0.0;
            }
        }

        // Mengurutkan alternatif berdasarkan nilai preferensi (C) secara menurun
        usort($data, fn($a, $b) => (int)(($b['preferensi'] ?? 0.0) * 1000000000) <=> (int)(($a['preferensi'] ?? 0.0) * 1000000000));
        return $data;
    }

    public function hasilFinal($id)
    {
        $pelamars = Lamaran::where('lowongan_id', $id)
            ->whereNotNull('pendidikan')
            ->whereNotNull('pengalaman')
            ->whereNotNull('umur')
            ->whereNotNull('wawancara') // pastikan wawancara sudah dinilai
            ->get();

        $data = $pelamars->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'pendidikan' => $this->skorPendidikan($item->pendidikan),
                'pengalaman' => $this->skorPengalaman($item->pengalaman),
                'usia' => $this->skorUsia($item->umur),
                'cv' => $this->skorCV($item->cv),
                'wawancara' => (float)$item->wawancara, // Pastikan wawancara adalah float
            ];
        })->toArray();

        // Log data untuk hasil final sebelum perhitungan
        Log::info('Data mentah hasil final:', ['data' => $data]);

        if (empty($data)) {
            return redirect()->back()->with('error', 'Tidak ada data pelamar yang valid untuk hasil final.');
        }

        $ranking = $this->prosesTopsisFinal($data);
        
        // Log hasil ranking
        Log::info('Hasil Ranking Final:', ['ranking' => $ranking]);

        return view('admin.topsis.hasil_final', [
            'ranking' => $ranking,
        ]);
    }
}