<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestasi extends Model
{
    use HasFactory;
    protected $table = 'prestasi';
    protected $fillable = [
        'id_peserta',
        'id_bidang',
        'id_tingkat',
        'id_jenis',
        'file',
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

    public function peserta() : BelongsTo
    {
        return $this->belongsTo(Peserta::class,'id_peserta');
    }

    public function bidang() : BelongsTo
    {
        return $this->belongsTo(Bidang::class,'id_bidang');
    }

    public function tingkat() : BelongsTo
    {
        return $this->belongsTo(Tingkat::class,'id_tingkat');
    }

    public function inkel() : BelongsTo
    {
        return $this->belongsTo(Inkel::class,'id_jenis');
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => url('/storage/prestasi/' .$value),
        );
    }

}
