<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tingkat extends Model
{
    use HasFactory;
    protected $table = 'tingkat';
    protected $fillable = ['nama','nilai'];
    public $incrementing = false;
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    protected function nama(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    public function prestasi() : HasMany
    {
        return $this->hasMany(Prestasi::class,'id_tingkat');
    }

}
