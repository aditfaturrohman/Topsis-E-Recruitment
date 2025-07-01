<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    protected $fillable = [
        'lowongan_id',
        'nama',
        'ttl',
        'pendidikan',
        'umur',
        'pengalaman',
        'cv',
        'status',
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
