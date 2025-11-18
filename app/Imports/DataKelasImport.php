<?php

namespace App\Imports;

use App\Models\Configurasi;
use App\Models\DataKelas;
use App\Models\DataSiswa;
use App\Models\SiswaKelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataKelasImport implements ToModel, WithHeadingRow
{
    protected $nama_kelas;
    protected $keterangan;

    // Terima data dari form lewat constructor
    public function __construct($nama_kelas, $keterangan)
    {
        $this->nama_kelas = $nama_kelas;
        $this->keterangan = $keterangan;
    }

    public function model(array $row)
    {
        $kelas = DataKelas::find($this->nama_kelas);
        $id_conf = Configurasi::where('status', 'aktif')->first();
        $row = array_map(fn($value) => $value === null || $value === '' ? '-' : $value, $row);

        $siswa = DataSiswa::where('nis', $row['nis'])->first();

        if (!$kelas || !$id_conf || !$siswa) {
            return null; // skip jika data tidak lengkap
        }

        return new SiswaKelas([
            'nisn'          => $row['nisn'] ?? '-',
            'nis'           => $row['nis'] ?? '-',
            'nama'          => $row['nama'] ?? '-',
            'kode_kelas'    => $kelas->kode_kelas,
            'nama_kelas'    => $kelas->nama_kelas,
            'keterangan'    => $this->keterangan,
            'user_create'   => auth()->user()->name ?? 'system',
            'edit_user'     => 'Null',
            'id_conf'       => $id_conf->id,
            'id_user_input' => auth()->user()->id ?? 1,
            'id_user_edit'  => null,
            'id_siswa'      => $siswa->id,
            'id_kelas'      => $kelas->id,
            'id_wali_kelas' => $kelas->id_wali_kelas,
        ]);
    }
}
