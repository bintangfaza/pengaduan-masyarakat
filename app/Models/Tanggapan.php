<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tanggapan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'tanggapan',
        'tanggal_tanggapan',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
