<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'kelas_x',
        'nama_wali_kelas_x',
        'id_kelas_x',
        'kelas_xi',
        'nama_wali_kelas_xi',
        'id_kelas_xi',
        'kelas_xii',
        'nama_wali_kelas_xii',
        'id_kelas_xii',
        'total_siswa',
        'jlh_siswa',
        'jlh_siswi',
        'keterangan',
        'user_input',
        'user_edit',
        'id_user'
    ];
}
