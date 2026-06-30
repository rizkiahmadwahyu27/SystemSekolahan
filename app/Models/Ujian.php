<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Tambahkan ini di atas jika belum ada
use Carbon\Carbon;

class Ujian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ujian',
        'mata_pelajaran_id',
        'tipe',
        'durasi',
        'mulai',
        'selesai',
        'deskripsi',
        'token',             // Tambahkan ini
        'token_updated_at',  // Tambahkan ini
    ];
// --- PERIKSA BAGIAN INI ---
    protected $casts = [
        'mulai' => 'datetime',
        'selesai' => 'datetime',
        'token_updated_at' => 'datetime', // <-- WAJIB ADA BARIS INI
    ];
    public function kategoris()
{
    return $this->belongsToMany(
        KategoriSoal::class,
        'ujian_kategoris',
        'ujian_id',
        'kategori_id'
    );
}
    public function getValidToken()
    {
        $sekarang = now();
        
        if (!$this->token || !$this->token_updated_at || $this->token_updated_at->diffInMinutes($sekarang) >= 15) {
            
            // Membuat 6 karakter acak kombinasi huruf & angka kapital
            $tokenBaru = strtoupper(Str::random(6)); 
            
            $this->update([
                'token' => $tokenBaru,
                'token_updated_at' => $sekarang
            ]);
        }

        return $this->token;
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'ujian_kelas');
    }

    public function soals()
    {
        return $this->hasMany(Soal::class);
    }

    public function hasilUjians()
    {
        return $this->hasMany(\App\Models\HasilUjian::class, 'ujian_id');
    }
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
