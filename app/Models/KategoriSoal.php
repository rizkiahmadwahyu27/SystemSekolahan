<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSoal extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama'
    ];

    public function ujians()
{
    return $this->belongsToMany(
        Ujian::class,
        'ujian_kategoris',
        'kategori_id',
        'ujian_id'
    );
}
public function soals()
    {
        return $this->hasMany(Soal::class, 'kategori_id');
    }
}
