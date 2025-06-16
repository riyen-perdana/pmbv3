<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    use HasFactory;
    protected $table = 'jalur_masuk';
    public $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nama',
        'prefiks',
        'is_aktif',
    ];
}
