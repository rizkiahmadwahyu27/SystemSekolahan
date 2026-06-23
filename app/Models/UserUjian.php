<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserUjian extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
    'nama',
    'no_peserta',
    'password',
    'nis',
    'kelas',
    'ruangan',
    'sesi',

    // status
    'is_active',
    'is_login',
    'is_finished',

    // device tracking
    'device_id',
    'session_id',

    // waktu
    'last_login',
    'start_time',
    'end_time',

    // lainnya
    'foto',
    'remember_token',
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_login' => 'boolean',
        'last_login' => 'datetime',
    ];

    public function hasilUjian()
{
    return $this->hasMany(HasilUjian::class);
}
}