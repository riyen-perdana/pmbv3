<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Jurusan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'jurusan';
    protected $fillable = [
        'kd_jurusan',
        'ket_jurusan'
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
     * Accessor dan Mutator Kode Jurusan kd_jurusan
     * @param $value
     * @return $value
     */
    protected function kdJurusan(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value),
            get: fn (string $value) => strtoupper($value)
        );
    }

    /**
     * Accessor dan Mutator Keterangan Jurusan ket_jurusan
     * @param $value
     * @return $value
     */
    protected function ketJurusan(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }
}
