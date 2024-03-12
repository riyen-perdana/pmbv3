<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    //, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'name',
        'glr_dpn',
        'glr_blk',
        'email',
        'password',
        'is_aktif'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes'
    ];

    /**
     * Append Nama Pengguna
     */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // protected $dates = ['deleted_at'];

    /**
    * The Custom attributes that should add to JSON response.
    *
    * @var array
    */
    protected $appends = ['full_nm_user'];

    /**
     * getPermissionArray
     *
     * @return void
     */
    public function getPermissionArray()
    {
        return $this->getAllPermissions()->mapWithKeys(function($pr){
            return [$pr['name'] => true];
        });

    }

    /**
     * Accessor dan Mutator Nama
     * @param $value
     * @return $value
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
            get: fn (string $value) => ucwords($value)
        );
    }

    /**
     * Accessor dan Mutator Full Nama Beserta Gelar Depan dan Belakang
     * @param $value
     * @return $value
     */
    public function getFullNmUserAttribute()
    {
        if ($this->glr_dpn == NULL || strlen(trim($this->glr_dpn) == 0))
        {
            return "{$this->name}.{$this->glr_blk}";
        } elseif ($this->glr_blk == NULL || strlen(trim($this->glr_blk) == 0))
        {
            return "{$this->glr_dpn}. {$this->name}";
        } elseif (($this->glr_dpn != NULL || strlen(trim($this->glr_dpn) != 0)) && ($this->glr_blk != null || strlen(trim($this->glr_blk) != 0)))
        {
            return "{$this->glr_dpn}. {$this->name}.{$this->glr_blk}";
        } else
        {
            return "{$this->name}";
        }
    }

    /**
     * Relasi Tabel Prodi dan Tabel Fakultas
     * @param void
     * @return relasi
     */
    public function rektor() : HasMany
    {
        return $this->hasMany(Rektor::class,'id_user');
    }

}
