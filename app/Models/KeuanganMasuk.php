<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuanganMasuk extends Model
{
    use HasFactory;

    protected $table = 'keuangan';
    protected $fillable = ['nominal', 'catatan', 'user_id', 'status', 'jumlah_uang'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}