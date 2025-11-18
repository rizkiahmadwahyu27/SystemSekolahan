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
            'nik', 'no_kk', 'nis', 'nisn', 'nama', 'jenis_kelamin', 'alamat', 'agama', 'tempat_lahir', 'tgl_lahir', 'sekolah_asal', 'anak_ke', 'no_hp', 'nama_ibu', 'pekerjaan_ibu', 'nama_ayah', 'pekerjaan_ayah', 'alamat_ortu', 'no_hp_ortu'
        ];
    }
}
