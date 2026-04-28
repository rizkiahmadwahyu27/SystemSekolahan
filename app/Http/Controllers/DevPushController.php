<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Minishlink\WebPush\VAPID;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class DevPushController extends Controller
{
    public function saveSubscription(Request $request)
{
    DB::table('web_push_tokens')->updateOrInsert(
        [
            'nis' => $request->nis,
            'endpoint' => $request->subscription['endpoint']
        ],
        [
            'p256dh' => $request->subscription['keys']['p256dh'],
            'auth' => $request->subscription['keys']['auth'],
            'updated_at' => now(),
            'created_at' => now(),
        ]
    );

    return response()->json(['success' => true]);
}

    
}
