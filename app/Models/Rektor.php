<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rektor extends Model
{
    use HasFactory;

    protected $table = 'rektor';
    protected $fillable = [
        'id_user',
        'rkt_awl_jbt',
        'rkt_akh_jbt',
        'is_rektor_aktif',
        'is_rektor_plt'
    ];
    protected $dates = ['rkt_awl_jbt','rkt_akh_jbt'];
    public $keyType = 'string';
    public $incrementing = false;


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    /**
     * Relasi Tabel Prodi dan Tabel Fakultas
     * @param void
     * @return relasi
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'id_user');
    }
}
