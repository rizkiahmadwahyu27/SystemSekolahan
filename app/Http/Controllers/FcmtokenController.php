<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use Illuminate\Http\Request;
use Google\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class FcmtokenController extends Controller
{
    public function index_token()
    {
        $vapidKey = config('webpush.vapid.public_key');
        $data_siswa = DataSiswa::select('id', 'nis', 'nama')->get();
        return view('notif', compact('data_siswa', 'vapidKey'));
    }

    public function saveToken(Request $request)
    {
        DB::table('fcmtokens')->updateOrInsert(
            [
                'nis' => $request->nis,
                'token' => $request->token
            ],
            [
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        return response()->json(['success' => true]);
    }

    // 🔑 Ambil access token dari Firebase (HTTP v1)
    
}
