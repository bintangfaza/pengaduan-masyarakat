<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;


    protected $fillable = [
        'judul',
        'isi',
        'foto',
        'kategori',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class);
    }
    
}
