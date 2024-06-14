<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sekolah extends Model
{
    use HasFactory;
    protected $table = 'sekolah';
    protected $fillable = ['id','kecamatan_id','nama','alamat'];
    public $keyType = 'string';
    public $incrementing = false;

    protected function id(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
            get: fn (string $value) => str_pad($value, 6, '0', STR_PAD_LEFT)
        );
    }

    protected function kecamatanID(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
            get: fn (string $value) => str_pad($value, 6, '0', STR_PAD_LEFT)
        );
    }

    protected function nama() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    protected function alamat() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    public function kecamatan() : BelongsTo
    {
        return $this->belongsTo(Kecamatan::class,'kecamatan_id');
    }

}
