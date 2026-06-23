<?php

namespace App\Imports;

use App\Models\Jawaban;
use App\Models\Soal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SoalImport implements ToCollection
{
    protected $ujian_id;
    protected $kategori_id;
    protected $tipe;

    public function __construct($ujian_id, $kategori_id, $tipe)
    {
        $this->ujian_id = $ujian_id;
        $this->kategori_id = $kategori_id;
        $this->tipe = $tipe;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) {

            // Ambil Kunci Jawaban dari Kolom G ($row[6])
            // Gunakan strtoupper & trim untuk menghindari error spasi atau huruf kecil (misal 'a' jadi 'A')
            $kunciDariExcel = isset($row[6]) ? strtoupper(trim($row[6])) : null;

            // Jika tipenya PG, kunci jawaban disimpan di tabel 'jawabans' (is_benar)
            // Tapi jika kamu tetap ingin mencatat huruf kuncinya di tabel 'soals', masukkan $kunciDariExcel
            // Jika tipe Essay, kolom G ($row[6]) bisa berisi teks jawaban essay-nya
            $soal = Soal::create([
                'ujian_id'      => $this->ujian_id,
                'kategori_id'   => $this->kategori_id,
                'tipe'          => $this->tipe,
                'pertanyaan'    => $row[0],          // Kolom A
                'kunci_jawaban' => $kunciDariExcel,  // Kolom G
                'bobot'         => $row[7] ?? 1,     // Kolom H (Jika kosong, default 1)
            ]);

            // Logika Khusus Pilihan Ganda (PG)
            if ($this->tipe == 'pg') {

                $opsi = [
                    'A' => $row[1], // Kolom B
                    'B' => $row[2], // Kolom C
                    'C' => $row[3], // Kolom D
                    'D' => $row[4], // Kolom E
                    'E' => $row[5], // Kolom F
                ];

                foreach ($opsi as $key => $value) {
                    if ($value !== null && $value !== '') {
                        Jawaban::create([
                            'soal_id'     => $soal->id,
                            'opsi'        => $key,
                            'isi_jawaban' => $value,
                            // Membandingkan huruf opsi (A/B/C/D/E) dengan Kunci dari Kolom G
                            'is_benar'    => ($kunciDariExcel === $key) 
                        ]);
                    }
                }
            }
        }
    }
}