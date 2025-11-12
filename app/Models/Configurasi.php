<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configurasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_sekolah',
        'nama_sekolah',
        'alamat',
        'no_hp',
        'semester',
        'tahun_ajaran',
        'status',
        'user_create',
        'edit_user',
        'id_user_input',
        'id_user_edit',
    ];
}
