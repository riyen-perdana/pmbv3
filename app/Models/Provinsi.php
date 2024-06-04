<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'provinsi';
    protected $fillable = ['id','nm_provinsi'];
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Accessor dan Mutator URL Website Prodi
     * @param $value
     * @return $value
     */
    protected function nmProvinsi(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => strtoupper($value),
        );
    }

    protected function id(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
            get: fn (string $value) => str_pad($value, 6, '0', STR_PAD_LEFT)
        );
    }

    protected function kabkot() : HasMany
    {
        return $this->hasMany('kabkot','prov_id');
    }

}
