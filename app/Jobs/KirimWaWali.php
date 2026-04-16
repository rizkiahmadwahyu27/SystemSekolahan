<?php

namespace App\Jobs;

use App\Models\Absensi;
use App\Models\SiswaKelas;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class KirimWaWali implements ShouldQueue
{
    use Dispatchable, Queueable;

    public $tries = 3;
    public $backoff = 10;

    protected $absen_id;

    public function __construct($absen_id)
    {
        $this->absen_id = $absen_id;
    }

   public function handle()
    {
        $absen = Absensi::with('siswaKelas.siswa')->find($this->absen_id);

        if (!$absen || !$absen->siswaKelas || !$absen->siswaKelas->siswa) {
            Log::error('DATA TIDAK VALID', [
                'absen_id' => $this->absen_id
            ]);
            return;
        }

        $siswa = $absen->siswaKelas->siswa;

        if (!$siswa->no_hp_ortu) {
            Log::warning('No HP kosong', ['absen_id' => $this->absen_id]);
            return;
        }

        $tanggal = Carbon::parse($absen->created_at)->format('d-m-Y'); 
        $jam = Carbon::parse($absen->created_at); 

        $waktu_akhir_tepat = Carbon::parse('06:30:00'); 
        $waktu_toleransi = Carbon::parse('07:00:00'); 

        if ($jam < $waktu_akhir_tepat) {
            $ket = 'tepat waktu';
        } elseif ($jam < $waktu_toleransi) {
            $ket = 'datang waktu toleransi';
        } else {
            $ket = 'terlambat';
        }

        $no = preg_replace('/[^0-9]/', '', $siswa->no_hp_ortu);
        if (substr($no, 0, 1) == '0') {
            $no = '62' . substr($no, 1);
        }

        $opening = [
            "Assalamu alaikum wr.wb 🙏",
            "Assalamualaikum wr wb 🙏",
            "Assalamu'alaikum Warahmatullahi Wabarakatuh 🙏"
        ];

        $intro = [
            "Kami dari SMK Pelita Jatibarang ingin menyampaikan informasi terkait kehadiran siswa:",
            "Berikut kami informasikan data absensi siswa hari ini:",
            "Dengan hormat, kami sampaikan informasi kehadiran siswa sebagai berikut:",
        ];

        $penutup = [
            "Demikian informasi yang dapat kami sampaikan. Terima kasih atas perhatian Bapak/Ibu 🙏",
            "Terima kasih atas perhatian dan kerjasamanya 🙏",
            "Demikian pemberitahuan ini kami sampaikan 🙏",
        ];

        $emojiStatus = [
            "hadir" => "✅",
            "izin" => "🟡",
            "sakit" => "🤒",
            "alpha" => "❌",
        ];

        $statusEmoji = $emojiStatus[strtolower($absen->status)] ?? "ℹ️";

        $pesan = $opening[array_rand($opening)] . "\n\n" .

            "Yth. Bapak/Ibu Wali Murid\n" .
            "👤 *{$siswa->nama}*\n\n" .

            $intro[array_rand($intro)] . "\n\n" .

            "📅 *Hari, Tanggal* : {$absen->hari}, {$tanggal}\n" .
            "⏰ *Jam* : ".$jam->format('H:i:s')."\n" .
            "{$statusEmoji} *Status* : {$absen->status}\n" .
            "📝 *Keterangan* : {$ket}\n\n" .

            $penutup[array_rand($penutup)];

        sleep(rand(5,15));

        $response = Http::timeout(10)->post('http://127.0.0.1:4000/send-message', [
            'number' => $no,
            'message' => $pesan
        ]);

        if ($response->successful()) {
            $absen->update([
                'is_sent' => 1,
                'status_sent' => 'success',
                'sent_at' => now()
            ]);
        } else {
            $absen->update([
                'status_sent' => 'failed'
            ]);

            throw new \Exception('Gagal kirim WA');
        }
    }
}
