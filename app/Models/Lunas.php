<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lunas extends Model
{
    use HasFactory;
    protected $table = 'lunas';
    protected $fillable = ['id','npsn','tgl_lahir'];
    public $keyType = 'string';
    public $incrementing = false;

}
