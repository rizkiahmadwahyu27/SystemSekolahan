<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ujian_id',
        'pilihan_1',
        'pilihan_2',
        'mulai',
        'selesai',
        'nilai_pg',
        'nilai_essay',
        'nilai_akhir'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function jawabanSiswa()
    {
        return $this->hasMany(JawabanSiswa::class);
    }
}
