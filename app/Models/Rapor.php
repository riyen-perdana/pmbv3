<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Rapor extends Model
{
    use HasFactory;
    protected $table = 'rapor';
    protected $fillable = [
        'peserta_id',
        'n_mtk',
        'n_bing',
        'file'
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
        return $this->belongsTo(Peserta::class,'peserta_id');
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/rapor/' . $value),
        );
    }

}
