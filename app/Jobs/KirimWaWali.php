<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class KirimWaWali implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $siswa;
    protected $absen;

    public function __construct($siswa, $absen)
    {
        $this->siswa = $siswa;
        $this->absen = $absen;
    }

    public function handle()
    {
        $tanggal = Carbon::parse($this->absen->created_at)->format('d-m-Y');
        $jam = Carbon::parse($this->absen->created_at);

        $waktu_akhir_tepat = Carbon::parse('06:30:00');
        $waktu_toleransi   = Carbon::parse('06:35:00');

        if ($jam < $waktu_akhir_tepat) {
            $ket = 'tepat waktu';
        } elseif ($jam >= $waktu_akhir_tepat && $jam < $waktu_toleransi) {
            $ket = 'datang waktu toleransi';
        } else {
            $ket = 'terlambat';
        }

        $pesan = "Assalamu alaikum wr.wb \n\n"
            ."Yth. Bapak/Ibu Wali Murid *{$this->siswa->nama}*\n\n"
            ."Kami pihak SMK Pelita Jatibarang menginformasikan bahwa:\n"
            ."Hari, Tanggal : *{$this->absen->hari}*, *{$tanggal}*\n"
            ."Jam : *{$jam->format('H:i:s')}*\n"
            ."Tempat : SMK Pelita Jatibarang\n"
            ."Status Kehadiran : *{$this->absen->status}*\n"
            ."Keterangan : *{$ket}*\n\n"
            ."Demikian informasi yang disampaikan.\n\n"
            ."Jatibarang, *{$tanggal}*\n"
            ."Kepala Sekolah,\n\n\n"
            ."Linda Tri Apsari, S.Pd";

        $nomor = $this->siswa->no_hp_ortu;

        if (preg_match('/^62\d{9,15}$/', $nomor)) {

            try {
                $response = Http::post(env('WA_BOT', 'http://localhost:4000/send-message'), [
                    'number' => $nomor,
                    'message' => $pesan
                ]);

                Log::info('Kirim WA sukses', $response->json());

            } catch (\Exception $e) {
                Log::error('Gagal kirim WA: '.$e->getMessage());
            }

        } else {
            Log::warning("Nomor tidak valid: {$nomor}");
        }
    }
}