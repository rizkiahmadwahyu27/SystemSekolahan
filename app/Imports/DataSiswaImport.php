<?php

namespace App\Imports;

use App\Models\Configurasi;
use App\Models\DataSiswa;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DataSiswaImport implements ToModel, WithHeadingRow
{
     public function model(array $row)
    {
         // Ganti nilai kosong menjadi "-"
         $id_conf = Configurasi::where('status', 'aktif')->first();
        $row = array_map(function($value) {
            return $value === null || $value === '' ? '-' : $value;
        }, $row);

        // Cek apakah data sudah ada di database (misal berdasarkan NIS)
        $exists = DataSiswa::where('nis', $row['nis'])->where('nik', $row['nik'])->exists();

        if ($exists) {
            // Jika sudah ada, skip import baris ini
            return null;
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
        return new DataSiswa([
            'nik'           => $row['nik'] ?? '-',
            'no_kk'         => $row['no_kk'] ?? '-',
            'nis'           => $row['nis'] ?? '-',
            'nisn'          => $row['nisn'] ?? '-',
            'nama'          => $row['nama'] ?? '-',
            'jenis_kelamin' => $row['jenis_kelamin'] ?? '-',
            'alamat'        => $row['alamat'] ?? '-',
            'agama'         => $row['agama'] ?? '-',
            'tempat_lahir'  => $row['tempat_lahir'] ?? '-',
            'tgl_lahir'     => $tgl_lahir,
            'sekolah_asal'  => $row['sekolah_asal'] ?? '-',
            'anak_ke'       => $row['anak_ke'] ?? 1,
            'no_hp'         => $row['no_hp'] ?? '-',
            'nama_ibu'      => $row['nama_ibu'] ?? '-',
            'pekerjaan_ibu' => $row['pekerjaan_ibu'] ?? '-',
            'nama_ayah'     => $row['nama_ayah'] ?? '-',
            'pekerjaan_ayah'=> $row['pekerjaan_ayah'] ?? '-',
            'alamat_ortu'   => $row['alamat_ortu'] ?? '-',
            'no_hp_ortu'    => $row['no_hp_ortu'] ?? '-',
            'created_by'    => auth()->user()->name ?? 'system',
            'edited_by'     => '-',
            'id_conf'       => $id_conf->id,
            'id_user_input' => auth()->id() ?? 1,
            'id_user_edit'  => null
        ]);
    }
}
