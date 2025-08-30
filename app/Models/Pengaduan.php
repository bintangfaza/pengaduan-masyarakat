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
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class);
    }
    
    public static function filterByStatus($status)
    {
        return self::where('status', $status)->get();
    }

}
