<?php

namespace App\Exports;

use App\Models\SiswaKelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataKelasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Pilih field yang ingin ditampilkan
        return SiswaKelas::select(
            'nisn',
            'nis',
            'nama',
            'kode_kelas',
            'nama_kelas',
            'keterangan',
            'user_create',
            'edit_user',
            'id_conf',
            'id_user_input',
            'id_user_edit',
            'id_siswa',
            'id_kelas',
            'id_wali_kelas',
        )->get();
    }

    public function headings(): array
    {
        return [
            'nisn',
            'nis',
            'nama',
            'kode kelas',
            'nama kelas',
            'keterangan',
            'user create',
            'edit user',
            'id conf',
            'id user input',
            'id user edit',
            'id siswa',
            'id kelas',
            'id wali kelas',
        ];
    }
}