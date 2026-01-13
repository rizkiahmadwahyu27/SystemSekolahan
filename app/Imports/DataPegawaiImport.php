<?php

namespace App\Imports;

use App\Models\Configurasi;
use App\Models\DataPegawai;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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

        $no_urut = DataPegawai::where('jabatan', $row['jabatan'])->count();
        $id_belakang = $no_urut + 1;
        if($row['jabatan'] == 'Ketua Yayasan'){
            $id_pegawai = 'kta_yys' . date('Y') . '000_' . $id_belakang;
        }
        elseif ($row['jabatan'] == 'Kepala Sekolah') {
            $id_pegawai = 'kpls' . date('Y') . '001_' . $id_belakang;
        }elseif ($row['jabatan'] == 'Waka Kurikulum' || $row['jabatan'] == 'Waka Kesiswaan' || $row['jabatan'] == 'Waka Humas') {
            $id_pegawai = 'waka' . date('Y') . '002_' . $id_belakang;
        }elseif ($row['jabatan'] == 'Kepala Tata Usaha') {
            $id_pegawai = 'kptu' . date('Y') . '003_' . $id_belakang;
        }elseif ($row['jabatan'] == 'Guru') {
            $id_pegawai = 'guru' . date('Y') . '004_' . $id_belakang;
        }else {
            $id_pegawai = 'stf' . date('Y') . '005_' . $id_belakang;
        }

        $tgl_lahir = '2000-01-01';

        if (isset($row['tgl_lahir']) && $row['tgl_lahir'] !== '-') {
            if (is_numeric($row['tgl_lahir'])) {
                // Jika SERIAL EXCEL
                $tgl_lahir = Date::excelToDateTimeObject($row['tgl_lahir'])
                    ->format('Y-m-d');
            } else {
                // Jika sudah STRING tanggal
                $tgl_lahir = Carbon::parse($row['tgl_lahir'])
                    ->format('Y-m-d');
            }
        }

        // Jika belum ada, buat data baru
        return new DataPegawai([
            'id_pegawai' => $id_pegawai ?? '-',
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
            'tgl_lahir' => $tgl_lahir,
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
