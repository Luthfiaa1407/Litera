<?php

namespace App\Http\Controllers;

use App\Mail\OtpEmail;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $user->update([
            'is_verified' => true,
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        // Login user
        Auth::login($user);

        session()->forget('otp_email');

        return redirect()->route('user.dashboard')->with('success', 'Berhasil login!');
    }

    public function resend(Request $request)
    {
        $email = session('otp_email');

        if (! $email) {
            return redirect('/login')->with('error', 'Session expired, silakan login kembali.');
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect('/register')->with('error', 'User tidak ditemukan.');
        }

        // Hapus OTP lama
        EmailVerification::where('email', $email)->delete();

        // Generate OTP baru
        $otp = rand(100000, 999999);

        EmailVerification::create([
            'user_id' => $user->id,
            'email' => $email,
            'otp' => $otp,
            'status' => 'active',
            'expires_at' => now()->addMinutes(10),
        ]);

        // Kirim email OTP
        Mail::to($email)->send(new OtpEmail($otp));

        return back()->with('success', 'OTP baru telah dikirim ke email Anda.');
    }
}
