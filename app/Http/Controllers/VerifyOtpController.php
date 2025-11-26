<?php

namespace App\Http\Controllers;

use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyOtpController extends Controller
{
    public function showVerifyForm()
    {
        $email = session('otp_email');

        if (! $email) {
            return redirect('/login')->with('error', 'Session expired, silakan login kembali.');
        }

        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = session('otp_email');

        if (! $email) {
            return redirect('/login')->with('error', 'Session expired.');
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect('/register')->with('error', 'User tidak ditemukan.');
        }

        $otpData = EmailVerification::where('email', $email)
            ->where('otp', $request->otp)
            ->where('status', 'active')
            ->first();

        if (! $otpData) {
            return back()->with('error', 'OTP salah.');
        }

        if ($otpData->expires_at < now()) {
            return back()->with('error', 'OTP kadaluarsa.');
        }

        // Tandai OTP sudah digunakan
        $otpData->update([
            'status' => 'used',
        ]);

        // Login user
        Auth::login($user);

        session()->forget('otp_email');

        return redirect()->route('user.dashboard')->with('success', 'Berhasil login!');
    }
}
