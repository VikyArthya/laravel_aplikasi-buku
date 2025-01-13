<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika sudah login, lanjutkan ke tujuan
        if (Auth::check()) {
            return $next($request);
        }

        // Jika belum login, arahkan ke halaman login
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
    }
}