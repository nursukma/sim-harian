<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    use HasFactory;

    protected $table = 'projeks';
    protected $fillable = [
        'nama_projek',
        'deskripsi',
        'keterangan',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}