<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prodi extends Model
{
    use HasFactory;
    protected $table = 'prodi';
    protected $fillable = [
        'kd_prodi',
        'id_fakultas',
        'id_jenjang',
        'id_akr_prodi',
        'nm_prodi',
        'url_prodi',
        'url_akr_prodi',
        'is_aktif',
        'is_pil_34',
    ];

    public $keyType = 'string';
    public $incrementing = false;
    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    /**
     * Relasi Tabel Prodi dan Tabel Fakultas
     * @param void
     * @return relasi
     */
    public function fakultas() : BelongsTo
    {
        return $this->belongsTo(Fakultas::class,'id_fakultas');
    }

    /**
     * Relasi Tabel Prodi dan Tabel Jenjang
     * @param void
     * @return relasi
     */
    public function jenjang() : BelongsTo
    {
        return $this->belongsTo(Jenjang::class,'id_jenjang');
    }

    /**
     * Relasi Tabel Prodi dan Tabel Akreditasi
     * @param void
     * @return relasi
     */
    public function akreditasi() : BelongsTo
    {
        return $this->belongsTo(Akreditasi::class,'id_akr_prodi');
    }

    /**
     * Accessor dan Mutator Nama Program Studi
     * @param $value
     * @return $value
     */
    protected function nmProdi(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    /**
     * Accessor dan Mutator URL Website Prodi
     * @param $value
     * @return $value
     */
    protected function urlProdi(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => strtolower($value)
        );
    }

    /**
     * Accessor dan Mutator URL Website Akreditasi Prodi
     * @param $value
     * @return $value
     */
    protected function urlAkrProdi(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => strtolower($value)
        );
    }
}
