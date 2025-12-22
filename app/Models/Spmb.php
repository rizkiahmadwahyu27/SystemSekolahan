<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spmb extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'nama_lengkap',
        'email',
        'tempat_tgl_lahir',
        'jenis_kelamin', 
        'agama', 
        'status_dalam_keluarga',
        'anak_ke',
        'alamat',
        'no_hp',
        'asal_sekolah',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'alamat_ortu',
        'no_hp_ortu',
        'minat_kompetensi',
    ];

    protected $casts = [
        'dokumen_pendaftaran' => 'array',
    ];
}
