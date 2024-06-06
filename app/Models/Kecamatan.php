<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $fillable = ['id','kabkot_id','nm_kecamatan'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function kabkot() : BelongsTo
    {
        return $this->belongsTo(Kabkot::class,'kabkot_id');
    }

    /**
     * Accessor dan Mutator Nama Kecamatan
     * @param $value
     * @return $value
     */
    protected function nmKecamatan() : Attribute
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
    protected function kabkotID() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
            get: fn (string $value) => str_pad($value, 6, '0', STR_PAD_LEFT)
        );
    }

}
