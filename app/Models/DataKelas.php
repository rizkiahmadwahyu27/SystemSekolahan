<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
        'nama_wali_kelas',
        'user_input',
        'user_edit',
        'id_conf',
        'id_wali_kelas',
        'id_user_input',
        'id_user_edit',
    ];
}
