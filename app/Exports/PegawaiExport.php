<?php

namespace App\Exports;

use App\Models\DataPegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PegawaiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Pilih field yang ingin ditampilkan
        return DataPegawai::select(
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
        )->get();
    }

    public function headings(): array
    {
        return [
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
}
