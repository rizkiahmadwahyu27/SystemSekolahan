<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $fillable = [
        'ujian_id',
        'kategori_id',
        'pertanyaan',
        'gambar',
        'tipe',
        'kunci_jawaban',
        'bobot'
    ];

    // relasi ke ujian
    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    // relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriSoal::class);
    }

    // relasi ke pilihan jawaban (PG)
    public function jawabans()
    {
        return $this->hasMany(Jawaban::class);
    }

    // relasi ke jawaban siswa
    public function jawabanSiswa()
    {
        return $this->hasMany(JawabanSiswa::class);
    }
}
