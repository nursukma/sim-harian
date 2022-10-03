<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    use HasFactory;

    protected $table = 'catatans';
    protected $fillable = ['catatan', 'user_id', 'kegiatan_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(KegiatanHarian::class, 'kegiatan_id', 'id');
    }
}