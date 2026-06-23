<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianKelas extends Model
{
    use HasFactory;
    protected $fillable = [
        'ujian_id',
        'kelas_id'
    ];
}
