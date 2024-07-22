<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fakultas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nm_fakultas',
        'id_akr_fakultas',
        //Refactoring Kelulusan Ujian Mandiri
        'id_user',
        'url_fakultas',
        'url_akr_fakultas',
        'is_aktif'

    ];
    protected $table = 'fakultas';
    public $keyType = 'string';
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    /**
     * Accessor dan Mutator Nama Fakultas nm_fakultas
     * @param $value
     * @return $value
     */
    protected function nmFakultas() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    /**
     * Relasi Tabel Fakultas ke Tabel Prodi Inverse
     * @param void
     * @return hasMany
     */
    public function prodi() : HasMany
    {
        return $this->hasMany(Prodi::class,'id_fakultas');
    }

    /**
     * Relasi Tabel Fakultas dan Tabel Akreditasi Reverse
     * @param void
     * @return belongsTo
     */
    public function akreditasi() : BelongsTo
    {
        return $this->belongsTo(Akreditasi::class,'id_akr_fakultas');
    }

    //Refactoring Kelulusan Ujian Mandiri
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'id_user');
    }
}
