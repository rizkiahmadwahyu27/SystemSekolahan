<?php

namespace App\Exports;

use App\Models\DataSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Pilih field yang ingin ditampilkan
        return DataSiswa::select('nik', 'no_kk', 'nis', 'nisn', 'nama', 'jenis_kelamin', 'alamat', 'agama', 'tempat_lahir', 'tgl_lahir', 'sekolah_asal', 'anak_ke', 'no_hp', 'nama_ibu', 'pekerjaan_ibu', 'nama_ayah', 'pekerjaan_ayah', 'alamat_ortu', 'no_hp_ortu')->get();
    }

    public function headings(): array
    {
        return [
            'ID',      // Judul kolom pertama
            'NIK',      // Judul kolom pertama
            'NO KK',      // Judul kolom pertama
            'NIS',     // Judul kolom kedua
            'NISN',     // Judul kolom kedua
            'NAMA',     // Judul kolom kedua
            'JENIS KELAMIN',     // Judul kolom kedua
            'ALAMAT',   // Judul kolom ketiga
            'AGAMA',   // Judul kolom ketiga
            'TEMPAT LAHIR',   // Judul kolom ketiga
            'TANGGAL LAHIR',   // Judul kolom ketiga
            'SEKOLAH ASAL',   // Judul kolom ketiga
            'ANAK KE',   // Judul kolom ketiga
            'NO HP/WA',   // Judul kolom ketiga
            'NAMA IBU',   // Judul kolom ketiga
            'PEKERJAAN IBU',   // Judul kolom ketiga
            'NAMA AYAH',   // Judul kolom ketiga
            'PEKERJAAN AYAH',   // Judul kolom ketiga
            'ALAMAT ORTU',   // Judul kolom ketiga
            'NO HP ORTU',   // Judul kolom ketiga
        ];
    }
}
