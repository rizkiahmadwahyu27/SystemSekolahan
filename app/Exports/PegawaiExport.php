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
        return DataPegawai::select('nuptk', 'nip', 'nik', 'nomor_sertif_pendidik', 'nama_pegawai', 'pendidikan_akhir', 'jurusan', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'agama', 'pangkat_or_golongan', 'jabatan', 'tugas_tambahan', 'nama_instansi', 'nama_instansi_cab', 'mata_pelajaran_1', 'mata_pelajaran_2', 'mata_pelajaran_3', 'mata_pelajaran_4', 'mata_pelajaran_5', 'mata_pelajaran_6', 'no_hp', 'alamat')->get();
    }

    public function headings(): array
    {
        return [
            'NUPTK',      // Judul kolom pertama
            'NIP',      // Judul kolom pertama
            'NIK',      // Judul kolom pertama
            'NOMOR SERTIFIKAT PENDIDIK',     // Judul kolom kedua
            'NAMA PEGAWAI',     // Judul kolom kedua
            'PENDIDIKAN_AKHIR',     // Judul kolom kedua
            'JURUSAN',     // Judul kolom kedua
            'JENIS KELAMIN',   // Judul kolom ketiga
            'TEMPAT LAHIR',   // Judul kolom ketiga
            'TANGGAL LAHIR',   // Judul kolom ketiga
            'AGAMA',   // Judul kolom ketiga
            'PANGKAT ATAU GOLONGAN',   // Judul kolom ketiga
            'JABATAN',   // Judul kolom ketiga
            'TUGAS TAMBAHAN',   // Judul kolom ketiga
            'NAMA INSTANSI',   // Judul kolom ketiga
            'NAMA INSTANSI CABANG',   // Judul kolom ketiga
            'MATA PELAJARAN 1',   // Judul kolom ketiga
            'MATA PELAJARAN 2',   // Judul kolom ketiga
            'MATA PELAJARAN 3',   // Judul kolom ketiga
            'MATA PELAJARAN 4',   // Judul kolom ketiga
            'MATA PELAJARAN 5',   // Judul kolom ketiga
            'MATA PELAJARAN 6',   // Judul kolom ketiga
            'NO HP/WA',   // Judul kolom ketiga
            'ALAMAT',   // Judul kolom ketiga
        ];
    }
}
