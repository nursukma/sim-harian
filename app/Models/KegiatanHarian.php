<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanHarian extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_harians';
    protected $fillable = ['kegiatan', 'user_id', 'projek_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function projek()
    {
        return $this->belongsTo(Projek::class, 'projek_id', 'id');
    }

    public function catatan()
    {
        return $this->hasMany(Catatan::class, 'kegiatan_id', 'id');
    }
}