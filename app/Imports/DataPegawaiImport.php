<?php

namespace App\Imports;

use App\Models\Configurasi;
use App\Models\DataPegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataPegawaiImport implements ToModel, WithHeadingRow
{
     public function model(array $row)
    {
         // Ganti nilai kosong menjadi "-"
         $id_conf = Configurasi::where('status', 'aktif')->first();
        $row = array_map(function($value) {
            return $value === null || $value === '' ? '-' : $value;
        }, $row);

        // Cek apakah data sudah ada di database (misal berdasarkan NIS)
        $exists = DataPegawai::where('id_pegawai', $row['id_pegawai'])->where('nip', $row['nip'])->where('nik', $row['nik'])->exists();

        if ($exists) {
            // Jika sudah ada, skip import baris ini
            return null;
        }

        // Jika belum ada, buat data baru
        return new DataPegawai([
            'id_pegawai' => $row['id_pegawai'] ?? '-',
            'id_pegawai_mutasi' => $row['id_pegawai_mutasi'] ?? '-',
            'nuptk' => $row['nuptk'] ?? '-',
            'nip' => $row['nip'] ?? '-',
            'nik' => $row['nik'] ?? '-',
            'nomor_sertif_pendidik' => $row['nomor_sertif_pendidik'] ?? '-',
            'nama_pegawai' => $row['nama_pegawai'] ?? '-',
            'pendidikan_akhir' => $row['pendidikan_akhir'] ?? '-',
            'jurusan' => $row['jurusan'] ?? '-',
            'jenis_kelamin' => $row['jenis_kelamin'] ?? '-',
            'tempat_lahir' => $row['tempat_lahir'] ?? '-',
            'tgl_lahir' => $row['tgl_lahir'] ?? '-',
            'agama' => $row['agama'] ?? '-',
            'pangkat_or_golongan' => $row['pangkat_or_golongan'] ?? '-',
            'jabatan' => $row['jabatan'] ?? '-',
            'tugas_tambahan' => $row['tugas_tambahan'] ?? '-',
            'nama_instansi' => $row['nama_instansi'] ?? '-',
            'nama_instansi_cab' => $row['nama_instansi_cab'] ?? '-',
            'mata_pelajaran_1' => $row['mata_pelajaran_1'] ?? '-',
            'mata_pelajaran_2' => $row['mata_pelajaran_2'] ?? '-',
            'mata_pelajaran_3' => $row['mata_pelajaran_3'] ?? '-',
            'mata_pelajaran_4' => $row['mata_pelajaran_4'] ?? '-',
            'mata_pelajaran_5' => $row['mata_pelajaran_5'] ?? '-',
            'mata_pelajaran_6' => $row['mata_pelajaran_6'] ?? '-',
            'no_hp' => $row['no_hp'] ?? '-',
            'alamat' => $row['alamat'] ?? '-',
            'user_input' => auth()->user()->name ?? 'system',
            'user_edit' => 'Null',
            'id_conf' => $id_conf->id,
            'id_user_input' => auth()->user()->id ?? 1,
            'id_user_edit' => null,
        ]);
    }
}
