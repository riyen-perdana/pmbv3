<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agama extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'agama';
    public $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nm_agama'
    ];
    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    /**
     * Accessor dan Mutator Nama Agama
     * @param $value
     * @return $value
     */
    protected function nmAgama(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

}
