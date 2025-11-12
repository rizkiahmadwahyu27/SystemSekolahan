<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'no_kk',
        'nis',
        'nisn',
        'nama',
        'jenis_kelamin',
        'alamat',
        'agama',
        'tempat_lahir',
        'tgl_lahir',
        'sekolah_asal',
        'anak_ke',
        'no_hp',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_ayah',
        'pekerjaan_ayah',
        'alamat_ortu',
        'no_hp_ortu',
        'created_by',
        'edited_by',
        'id_conf',
        'id_user_input',
        'id_user_edit',
    ];
}
