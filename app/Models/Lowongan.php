<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'lokasi', 'batas_lamaran'];
}
