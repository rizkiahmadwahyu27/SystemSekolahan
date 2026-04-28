<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class KirimNotifJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $nis;
    public $title;
    public $body;

    // 🔥 retry & timeout
    public $tries = 3;
    public $timeout = 60;

    public function __construct($nis, $title, $body)
    {
        $this->nis = $nis;
        $this->title = $title;
        $this->body = $body;
    }

    public function handle()
    {
        try {

            Log::info("Start KirimNotifJob untuk NIS: {$this->nis}");

            // ✅ VAPID config
            $auth = [
                'VAPID' => [
                    'subject' => config('webpush.vapid.subject'),
                    'publicKey' => config('webpush.vapid.public_key'),
                    'privateKey' => config('webpush.vapid.private_key'),
                ],
            ];


            Log::info('VAPID FINAL', [
                'subject' => config('webpush.vapid.subject'),
                'publicKey' => config('webpush.vapid.public_key'),
                'privateKey' => config('webpush.vapid.private_key'),
            ]);
            
            $webPush = new WebPush($auth);

            // ambil subscription dari DB
            $subs = DB::table('web_push_tokens')
                ->where('nis', $this->nis)
                ->get();

            if ($subs->isEmpty()) {
                Log::warning("Tidak ada subscription untuk NIS: {$this->nis}");
                return;
            }

            Log::info("Total subscription: " . count($subs));

            // ========================
            // QUEUE SEMUA NOTIF
            // ========================
            foreach ($subs as $sub) {

                // validasi data
                if (empty($sub->endpoint) || empty($sub->p256dh) || empty($sub->auth)) {
                    Log::warning("Subscription tidak valid, skip");
                    continue;
                }

                try {

                    $subscription = Subscription::create([
                        'endpoint' => $sub->endpoint,
                        'keys' => [
                            'p256dh' => $sub->p256dh,
                            'auth' => $sub->auth,
                        ],
                    ]);

                    $payload = json_encode([
                        'title' => $this->title,
                        'body' => $this->body,
                        'nis' => $this->nis,
                        'time' => now()->toDateTimeString(),
                    ]);

                    $webPush->queueNotification($subscription, $payload);

                } catch (\Throwable $e) {
                    Log::error("Subscription error: " . $e->getMessage());
                }
            }

            // ========================
            // KIRIM SEMUA (FLUSH)
            // ========================
            foreach ($webPush->flush() as $report) {

                $endpoint = $report->getRequest()->getUri()->__toString();
                $reason = $report->getReason();

                if ($report->isSuccess()) {

                    Log::info("Notif sukses ke: " . $endpoint);

                } else {

                    Log::error("Notif gagal ke: {$endpoint} | Reason: {$reason}");

                    // 🔥 hapus subscription mati / invalid
                    if (
                        $report->isSubscriptionExpired() ||
                        str_contains($reason, '410') ||
                        str_contains($reason, '404')
                    ) {
                        DB::table('web_push_tokens')
                            ->where('endpoint', $endpoint)
                            ->delete();

                        Log::info("Subscription dihapus: " . $endpoint);
                    }
                }
            }

            Log::info("Selesai KirimNotifJob NIS: {$this->nis}");

        } catch (\Throwable $e) {
            Log::error("KirimNotifJob ERROR: " . $e->getMessage());
        }
    }
}