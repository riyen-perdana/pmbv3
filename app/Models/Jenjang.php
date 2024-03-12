<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jenjang extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_jenjang',
        'nm_jenjang',
        'is_aktif'
    ];
    protected $table = 'jenjang';
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
     * Accessor dan Mutator Kode Jenjang Pendidikan
     * function kdJenjang
     * @param $value
     * @return $value
     */
    protected function kdJenjang(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    /**
     * Accessor dan Mutator Nama Jenjang
     * @param $value
     * @return $value
     */
    // protected function nmJenjang(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn (string $value) => strtolower($value),
    //         get: fn (string $value) => ucwords($value)
    //     );
    // }

    /**
     * Function prodi
     * Relasi Tabel Jenjang ke Tabel Prodi
     * @param void
     * @return relasi
     */
    public function prodi() {
        return $this->hasMany(Prodi::class,'id_jenjang');
    }
}
