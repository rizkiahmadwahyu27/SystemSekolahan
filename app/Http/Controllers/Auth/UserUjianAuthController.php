<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserUjianAuthController extends Controller
{
    

    public function showLogin(Request $request)
    {
        $request->validate([
            'no_peserta' => 'required|string',
            'password'   => 'required',
        ]);

        $siswa = \App\Models\UserUjian::where('no_peserta', $request->no_peserta)->first();

        if (!$siswa || !Hash::check($request->password, $siswa->password)) {
            // Dipastikan kembali ke halaman tampilan login (GET)
            return redirect()->route('ujian.login')
                ->withInput($request->only('no_peserta'))
                ->withErrors(['no_peserta' => 'Nomor peserta atau password salah!']);
        }

        Auth::guard('user_ujian')->login($siswa);
        $siswa->update(['session_id' => session()->getId()]);

        return redirect()->route('dashboard.ujian');
    }

    public function logout()
    {
        $user = Auth::guard('user_ujian')->user();

        if ($user) {
            $user->update([
                'is_login' => false
            ]);
        }

        Auth::guard('user_ujian')->logout();

        // 🟢 PERBAIKAN: Lempar ke nama route halaman login (GET), bukan URL POST
        return redirect()->route('ujian.login')->with('success', 'Anda telah berhasil keluar dari sistem ujian.');
    }
}