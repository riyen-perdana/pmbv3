<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Seleksi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'seleksi';
    protected $fillable = [
        'nm_seleksi',
        'pref_seleksi',
        'is_aktif'
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
     * Accessor dan Mutator Nama Seleksi
     * function nmSeleksi
     * @param $value
     * @return $value
     */
    protected function nmSeleksi(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }
}
