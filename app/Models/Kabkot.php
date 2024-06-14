<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kabkot extends Model
{
    use HasFactory;

    protected $table = 'kabkot';
    protected $fillable = ['id','prov_id','nm_kabkot'];
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Relasi Tabel Kabkot ke Provinsi
     * BelongsTo
     */
    public function provinsi() : BelongsTo
    {
        return $this->belongsTo(Provinsi::class,'prov_id');
    }

    /**
     * Accessor dan Mutator Nama Kabupaten Kota
     * @param $value
     * @return $value
     */
    protected function nmKabkot() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => strtoupper($value),
        );
    }


    /**
     * Accessor dan Mutator ID
     * @param $value
     * @return $value
     */
    protected function id() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
            get: fn (string $value) => str_pad($value, 6, '0', STR_PAD_LEFT)
        );
    }

    /**
     * Accessor dan Mutator Provinsi ID
     * @param $value
     * @return $value
     */
    protected function provId() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
            get: fn (string $value) => str_pad($value, 6, '0', STR_PAD_LEFT)
        );
    }

    protected function kecamatan() : HasMany
    {
        return $this->hasMany(Kecamatan::class,'kabkot_id');
    }

}
