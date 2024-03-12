<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dekan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'dekan';
    protected $fillable = [
        'id_user',
        'id_prodi',
        'is_dekan_aktif',
        'is_dekan_plt'
    ];
    protected $dates = ['deleted_at'];
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
     * Function User
     * Relasi Tabel Dekan ke Tabel User
     * @param void
     * @return relasi
     */
    public function user() : HasOne
    {
        return $this->hasOne(User::class,'id_user');
    }

    /**
     * Function prodi
     * Relasi Tabel Dekan ke Tabel Prodi
     * @param void
     * @return
     */
    public function prodi() : BelongsTo
    {
        return $this->belongsTo(Prodi::class,'id_prodi');
    }
}
