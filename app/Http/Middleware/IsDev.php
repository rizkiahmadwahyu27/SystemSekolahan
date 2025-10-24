<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsDev
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level === 'dev') {
            return $next($request);
        }

        // Jika ini adalah permintaan AJAX/API, kembalikan respons 403 JSON
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Kamu tidak punya akses ke halaman ini.'], 403);
        }

        // Jika ini adalah permintaan Web biasa, lakukan redirect
        return redirect('/')->with('error', 'Kamu tidak punya akses ke halaman ini.');
    }
}
