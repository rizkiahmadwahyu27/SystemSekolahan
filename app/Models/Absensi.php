<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'guru',
        'jenis_absen',
        'hari',
        'tanggal',
        'status',
        'keterangan',
        'user_input',
        'user_edit',
        'id_conf',
        'id_user_input',
        'id_user_edit',
        'id_siswa',
        'id_wali_kelas',
        'id_kelas',
    ];
}
