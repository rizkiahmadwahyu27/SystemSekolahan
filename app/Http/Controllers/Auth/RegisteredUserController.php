<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\DataSiswa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $siswa = DataSiswa::where('nis', $request->kode)->first();
        $pegawai = DataPegawai::where('id_pegawai', $request->kode)->first();
        if ($siswa) {
            $user = User::create([
                'id_user' => $request->kode,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 'siswa',
            ]);
        }elseif ($pegawai){
            $user = User::create([
                'id_user' => $request->kode,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => $request->level,
            ]);
        }else{
            return redirect()->back()->with('error', 'Maaf kode kamu tidak sesuai!');
        }

        event(new Registered($user));

        Auth::login($user);

        $level = Auth::user()->level;
        $url = '/' . $level . '/dashboard';
        return redirect($url);
    }
}
