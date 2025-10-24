<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

       $level = strtolower(trim($user->level));

        if ($level == 'admin') {
            return redirect()->route('admin.index');
        } elseif ($level == 'guru') {
            return redirect()->route('guru.index');
        } elseif ($level == 'dev') {
            return redirect()->route('dev.index');
        } elseif ($level == 'kepsek') {
            return redirect()->route('kepsek.index');
        } elseif ($level == 'siswa') {
            return redirect()->route('siswa.index');
        }

        // Default fallback jika level tidak dikenali
        $level = Auth::user()->level;
        $url = '/' . $level . '/dashboard';
        return redirect($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
