<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table= 'ruang';
    protected $fillable = [
        'nm_ruang',
        'tgl_ujian',
        'sesi_ruang',
        'waktu_ujian',
        'waktu_simulasi',
        'nomor_ruang',
        'jln_kursi',
        'no_awal',
        'no_akhir'
    ];
    protected $dates = ['tgl_ujian','deleted_at'];
    public $keyType = 'string';
    public $incrementing = 'false';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    /**
     * Accessor dan Mutator Nama Ruangan Ujian
     * @param $value
     * @return $value
     */
    protected  function nmRuang() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }
}
