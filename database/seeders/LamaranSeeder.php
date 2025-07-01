<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lamaran;

class LamaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Andi', 'pendidikan' => 'S1', 'umur' => 25, 'pengalaman' => 3, 'cv' => 'cv/andi.pdf', 'ttl' => '2000-01-01', 'status' => 'pending', 'lowongan_id' => 1],
            ['nama' => 'Budi', 'pendidikan' => 'SMA/SMK', 'umur' => 22, 'pengalaman' => 1, 'cv' => 'cv/budi.pdf', 'ttl' => '2002-03-01', 'status' => 'pending', 'lowongan_id' => 1],
            ['nama' => 'Citra', 'pendidikan' => 'D3', 'umur' => 29, 'pengalaman' => 4, 'cv' => 'cv/citra.pdf', 'ttl' => '1996-06-01', 'status' => 'pending', 'lowongan_id' => 1],
            ['nama' => 'Dewi', 'pendidikan' => 'SMP', 'umur' => 19, 'pengalaman' => 0, 'cv' => null, 'ttl' => '2006-02-10', 'status' => 'pending', 'lowongan_id' => 1],
            ['nama' => 'Eka', 'pendidikan' => 'S1', 'umur' => 35, 'pengalaman' => 5, 'cv' => 'cv/eka.pdf', 'ttl' => '1989-08-15', 'status' => 'pending', 'lowongan_id' => 1],
            ['nama' => 'Fajar', 'pendidikan' => 'SD', 'umur' => 40, 'pengalaman' => 2, 'cv' => null, 'ttl' => '1985-04-12', 'status' => 'pending', 'lowongan_id' => 1],
            ['nama' => 'Gina', 'pendidikan' => 'SMA/SMK', 'umur' => 23, 'pengalaman' => 1, 'cv' => 'cv/gina.pdf', 'ttl' => '2001-01-01', 'status' => 'pending', 'lowongan_id' => 1],
            ['nama' => 'Hadi', 'pendidikan' => 'SMP', 'umur' => 31, 'pengalaman' => 3, 'cv' => 'cv/hadi.pdf', 'ttl' => '1994-11-25', 'status' => 'pending', 'lowongan_id' => 1],
            ['nama' => 'Intan', 'pendidikan' => 'D3', 'umur' => 21, 'pengalaman' => 2, 'cv' => 'cv/intan.pdf', 'ttl' => '2003-09-20', 'status' => 'pending', 'lowongan_id' => 1],
            ['nama' => 'Joko', 'pendidikan' => 'S1', 'umur' => 28, 'pengalaman' => 4, 'cv' => 'cv/joko.pdf', 'ttl' => '1997-12-12', 'status' => 'pending', 'lowongan_id' => 1],
        ];

        foreach ($data as $item) {
            Lamaran::create($item);
        }
    }
}
