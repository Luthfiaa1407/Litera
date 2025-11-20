<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Jika belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika bukan admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->withErrors([
                'error' => 'Akses ditolak. Anda bukan admin.'
            ]);
        }

        // Jika admin, lanjutkan
        return $next($request);
    }
}
