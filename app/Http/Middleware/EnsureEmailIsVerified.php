<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        // Jika belum login, lanjut ke middleware auth
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika belum verifikasi email
        if (!Auth::user()->is_verified) {

            // Simpan email di session untuk OTP
            session(['otp_email' => Auth::user()->email]);

            return redirect()->route('verify.otp.form')
                ->with('error', 'Email Anda belum diverifikasi. Silakan masukkan OTP.');
        }

        return $next($request);
    }
}
