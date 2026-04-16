<?php

namespace App\Console\Commands;

use App\Jobs\KirimWaWali;
use App\Models\Absensi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class KirimBatchWa extends Command
{
    protected $signature = 'kirim:batch-wa';

    public function handle()
{
    if (now()->hour < 6 || now()->hour > 18) {
        $this->info("Diluar jam kirim");
        return;
    }

    $data = Absensi::where('is_sent', 0)
        ->where('status_sent', 'pending')
        ->whereNotNull('id_siswa')
        ->orderBy('created_at', 'asc')
        ->limit(5)
        ->get();

    $delay = 0;

    foreach ($data as $item) {

        if (!$item || !$item->id) {
            continue;
        }

        // 🔥 LOCK biar tidak double
        $item->update([
            'status_sent' => 'processing'
        ]);

        KirimWaWali::dispatch($item->id)
            ->delay(now()->addSeconds($delay));

        $delay += rand(120, 360);
    }

    Log::info("Batch kirim: ".$data->count());

    $this->info("Kirim: ".$data->count());
}
}