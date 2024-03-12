<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Akreditasi extends Model
{
    use HasFactory;
    protected $table = 'akreditasi';
    protected $fillable = [
        'jns_akreditasi',
        'is_aktif'
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

    /**
     * Accessor dan Mutator Jenis Akreditasi jns_akreditasi
     * @param $value
     * @return $value
     */
    protected function jnsAkreditasi() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    /**
     * Relasi Tabel Akreditasi dan Tabel fakultas
     * @param void
     * @return hasMany
     */
    public function fakultas() : HasMany
    {
        return $this->hasMany(Fakultas::class,'id_akr_fakultas');
    }

}
