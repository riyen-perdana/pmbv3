<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    use HasFactory;
    protected $table = 'jalur_masuk';
    protected $fillable = [
        'nama',
        'tahun',
        'semester',
        'nominal_pendaftaran',
        'tgl_pr_buka',
        'tgl_pr_tutup',
        'tgl_byr_buka',
        'tgl_byr_tutup',
        'tgl_dft_buka',
        'tgl_dft_tutup',
        'tgl_pengumuman',
        'pilihan',
        'is_aktif',
        'prefiks'
    ];
}
