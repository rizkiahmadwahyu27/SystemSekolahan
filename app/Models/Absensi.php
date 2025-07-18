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
        'id_user',
    ];
}
