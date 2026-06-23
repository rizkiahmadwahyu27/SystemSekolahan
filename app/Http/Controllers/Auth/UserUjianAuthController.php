<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserUjianAuthController extends Controller
{
    
    public function showLogin()
    {
        return view('appujian.login_ujian');
    }

    public function login(Request $request)
    {
        $request->validate([
            'no_peserta' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('user_ujian')->attempt([
            'no_peserta' => $request->no_peserta,
            'password' => $request->password,
        ])) {

            $user = Auth::guard('user_ujian')->user();

            $user->update([
                'is_login' => true,
                'last_login' => now(),
                'session_id' => session()->getId(),
                'device_id' => request()->userAgent(),
            ]);

            return redirect('/ujian/dashboard');
        }

        return back()->with('error', 'No peserta atau password salah');
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

        return redirect('/ujian/login');
    }

}
