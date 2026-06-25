<?php

namespace App\Imports;

use App\Models\UserUjian;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PesertaImport implements ToModel, WithHeadingRow
{
    // Variabel tampungan untuk menyimpan kelas dari request form web
    protected $kelasDariRequest;

    // Constructor untuk menerima data kelas dari Controller
    public function __construct($kelas)
    {
        $this->kelasDariRequest = $kelas;
    }

    public function model(array $row)
    {
        // Sekarang kita tidak butuh $row['kelas'] lagi karena diambil dari form web
        if (!isset($row['nama']) || !isset($row['no_peserta'])) {
            return null;
        }

        return new UserUjian([
            'nama'        => $row['nama'],
            'no_peserta'  => $row['no_peserta'],
            'password'    => Hash::make($row['password']),
            'nis'         => $row['nis'] ?? null,
            'kelas'       => $this->kelasDariRequest, // <-- Diisi otomatis dari request form web
            'ruangan'     => $row['ruangan'] ?? null,
            'sesi'        => $row['sesi'] ?? null,
            'is_active'   => true,
            'is_login'    => false,
        ]);
    }
}