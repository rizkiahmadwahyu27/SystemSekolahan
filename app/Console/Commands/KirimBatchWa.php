<?php

namespace App\Console\Commands;

use App\Jobs\KirimWaWali;
use App\Models\Absensi;
use Illuminate\Console\Command;

class KirimBatchWa extends Command
{
    protected $signature = 'kirim:batch-wa';

    public function handle()
{
    $data = Absensi::where('is_sent', 0)
        ->where('status_sent', 'pending')
        ->whereNotNull('id_siswa') // 🔥 penting
        ->limit(30)
        ->get();

    $delay = 0;

    foreach ($data as $item) {

        // 🔥 skip kalau data aneh
        if (!$item || !$item->id) {
            continue;
        }

        KirimWaWali::dispatch($item->id) // ✅ kirim ID saja
            ->delay(now()->addSeconds($delay));

        $delay += rand(5, 10);
    }

    $this->info("Kirim: ".$data->count());
}
}