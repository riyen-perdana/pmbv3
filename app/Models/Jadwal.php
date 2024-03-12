<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jadwal';
    protected $fillable = [
        'id_seleksi',
        'nominal',
        'tahun',
        'pr_daftar_awal',
        'pr_daftar_akhir',
        'byr_awal',
        'byr_akhir',
        'dft_awal',
        'dft_akhir',
        'pengumuman_kelulusan',
        'is_aktif'
    ];
    protected $dates = [
        'pr_daftar_awal',
        'pr_daftar_akhir',
        'byr_awal',
        'byr_akhir',
        'dft_awal',
        'dft_akhir',
        'pengumuman_kelulusan',
        'deleted_at'
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

}
