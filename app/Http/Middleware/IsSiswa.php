<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSiswa
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level === 'siswa') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Kamu tidak punya akses ke halaman ini.');
    }
}
