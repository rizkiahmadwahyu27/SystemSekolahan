<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'nis',
        'nama',
        'kode_kelas',
        'nama_kelas',
        'keterangan',
        'user_create',
        'edit_user',
        'id_conf',
        'id_user_input',
        'id_user_edit',
        'id_siswa',
        'id_kelas',
        'id_wali_kelas',
    ];
}
