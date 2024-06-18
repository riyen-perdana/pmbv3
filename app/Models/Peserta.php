<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Peserta extends Authenticatable
{
    use HasFactory;
    protected $table = 'peserta';
    protected $fillable = [
        'id',
        'jalur',
        'nik_siswa',
        'nisn_siswa',
        'npsn',
        'password',
        'first_password',
        'pin',
        'nm_siswa',
        'tptlhr_siswa',
        'tgllhr_siswa',
        'jklmn_siswa',
        'fotosiswa',
        'almt_siswa',
        'agm_siswa',
        'email_siswa',
        'notlpn_siswa',
        'pil1_siswa',
        'pil2_siswa',
        'pil3_siswa',
        'pil4_siswa',
        'jlmbayar_siswa',
        'is_bayar',
        'tglbayar_siswa',
        'is_lulus',
        'prodills_siswa',
        'is_vrf_op',
        'dok_nilai_siswa',
    ];

    public $keyType = 'string';
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    protected function nmSiswa(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    protected function tptlhrSiswa() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }



}
