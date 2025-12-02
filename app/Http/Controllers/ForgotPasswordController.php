<?php

namespace App\Http\Controllers;

use App\Mail\CustomResetPassword;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Generate token untuk reset password
        $token = Password::createToken($user);

        // Generate OTP
        $otp = rand(100000, 999999);

        EmailVerification::create([
            'email' => $user->email,
            'otp' => $otp,
            'status' => 'active',
            'expires_at' => now()->addMinutes(5),
        ]);

        // SIMPAN DATA UNTUK VERIFIKASI RESET PASSWORD
        session([
            'otp_mode' => 'reset_password',
            'otp_email' => $user->email,
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
            'reset_token' => $token,
        ]);

        // URL reset password
        $resetUrl = url('/reset-password/'.$token.'?email='.$user->email);

        // Kirim email
        Mail::to($user->email)->send(new CustomResetPassword(
            $otp,
            $resetUrl,
            $user->name
        ));

        return redirect()->route('verify.otp.form')
            ->with('success', 'OTP dan link reset password telah dikirim.');
    }
}
