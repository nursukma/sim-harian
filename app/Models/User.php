<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function absen()
    {
        return $this->hasMany(Absen::class, 'user_id', 'id');
    }

    public function projek()
    {
        return $this->hasMany(Projek::class, 'user_id', 'id');
    }

    public function kegiatan()
    {
        return $this->hasMany(KegiatanHarian::class, 'user_id', 'id');
    }

    public function catatan()
    {
        return $this->hasMany(Catatan::class, 'user_id', 'id');
    }

    public function keuangan()
    {
        return $this->hasMany(KeuanganMasuk::class, 'user_id', 'id');
    }
}