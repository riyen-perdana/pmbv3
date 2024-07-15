<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Peserta extends Authenticatable
{
    use HasFactory;
    protected $table = 'peserta';
    protected $fillable = [
        'id',
        'jalur',
        'nik_siswa',
        'nisn_siswa',
        'npsn',
        'password',
        'first_password',
        'pin',
        'nm_siswa',
        'tptlhr_siswa',
        'tgllhr_siswa',
        'jklmn_siswa',
        'foto_siswa',
        'almt_siswa',
        'agm_siswa',
        'email_siswa',
        'notlpn_siswa',
        'pil1_siswa',
        'pil2_siswa',
        'pil3_siswa',
        'pil4_siswa',
        'jlmbayar_siswa',
        'is_bayar',
        'tglbayar_siswa',
        'is_lulus',
        'prodills_siswa',
        'is_vrf_op',
        'nomor',
        'is_vrf_siswa',
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

    protected function nmSiswa(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    protected function tptlhrSiswa() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    protected function fotoSiswa() : Attribute
    {
        return Attribute::make(
            get: fn (string $value) => url('/storage/fotopeserta/' .$value),
        );
    }

    protected function almtSiswa() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    public function sekolah() : BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'npsn', 'id');
    }

    public function prestasi() : HasMany
    {
        return $this->hasMany(Prestasi::class, 'id_peserta');
    }

    public function rapor() : HasOne
    {
        return $this->hasOne(Rapor::class, 'peserta_id');
    }

    public function pil_1() : BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'pil1_siswa');
    }

    public function pil_2() : BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'pil2_siswa');
    }

    public function pil_3() : BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'pil3_siswa');
    }

    public function pil_4() : BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'pil4_siswa');
    }

}
