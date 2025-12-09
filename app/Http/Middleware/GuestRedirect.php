<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuestRedirect
{
    public function handle($request, Closure $next)
    {
        // Jika sudah login (admin maupun user)
        if (Auth::check()) {

            // Admin → arahkan ke admin dashboard
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // User → arahkan ke dashboard user
            return redirect()->route('user.dashboard');
        }

        // Jika belum login → biarkan akses halaman guest
        return $next($request);
    }
}
