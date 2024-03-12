<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahAsal extends Model
{
    use HasFactory;
    protected $fillable = [
        'npsn',
        'id_sekolah',
        'nm_sekolah',
        'bntk_sekolah',
        'almt_sekolah',
        'kode_prop',
        'prop_sekolah',
        'kode_kab_kota',
        'kab_kota_sekolah',
        'kode_kec',
        'kec_sekolah',
        'ltg_sekolah',
        'bjr_sekolah'
    ];
    protected $hidden = 'id';
}
