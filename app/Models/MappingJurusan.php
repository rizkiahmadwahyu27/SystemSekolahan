<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingJurusan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_jurusan',
        'kategori_id',
        'minimal_nilai'
    ];
}
