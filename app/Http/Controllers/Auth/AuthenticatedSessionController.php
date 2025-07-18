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

        // Redirect berdasarkan level user
        switch ($user->level) {
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'guru':
                return redirect()->intended('/guru/dashboard');
            case 'siswa':
                return redirect()->intended('/siswa/dashboard');
            case 'kepsek':
                return redirect()->intended('/kepsek/dashboard');
            case 'dev':
                return redirect()->intended('/dev/dashboard');
            default:
                return redirect()->intended('/'); // fallback
        }
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
