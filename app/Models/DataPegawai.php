<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pegawai',
        'id_pegawai_mutasi',
        'nuptk',
        'nip',
        'nik',
        'nomor_sertif_pendidik',
        'nama_pegawai',
        'pendidikan_akhir',
        'jurusan',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'pangkat_or_golongan',
        'jabatan',
        'tugas_tambahan',
        'nama_instansi',
        'nama_instansi_cab',
        'mata_pelajaran_1',
        'mata_pelajaran_2',
        'mata_pelajaran_3',
        'mata_pelajaran_4',
        'mata_pelajaran_5',
        'mata_pelajaran_6',
        'no_hp',
        'alamat',
        'user_input',
        'user_edit',
        'id_conf',
        'id_user_input',
        'id_user_edit',
    ];
}
