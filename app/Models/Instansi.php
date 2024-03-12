<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Instansi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'instansi';
    protected $fillable = [
        'abbr_instansi',
        'nm_instansi',
        'almt_instansi',
        'no_telp_instansi'
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
     * Accessor dan Mutator Nama Instansi nm_instansi
     * @param $value
     * @return $value
     */
    protected function nmInstansi(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    /**
     * Accessor dan Mutator Alamat Instansi almt_instansi
     * @param $value
     * @return $value
     */
    protected function almtInstansi(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }
}
