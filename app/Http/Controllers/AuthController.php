<?php

namespace App\Http\Controllers;

use App\Mail\OtpEmail;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /* Tampilkan halaman registrasi */
    public function showRegister()
    {
        return view('auth.register');
    }

    /* Proses registrasi pengguna baru */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengguna',
        ]);

        // Buat OTP
        $otp = rand(100000, 999999);

        EmailVerification::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'otp' => $otp,
            'status' => 'active',
            'expires_at' => now()->addMinutes(10),
        ]);

        // Simpan session
        session([
            'otp_mode' => 'verification',
            'otp_email' => $request->email,
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        // Kirim OTP
        Mail::to($user->email)->send(new OtpEmail($otp));

        return redirect()->route('verify.otp.form')
            ->with('success', 'Registrasi berhasil. Cek email untuk OTP!');
    }

    /* Tampilkan halaman login */
    public function showLogin()
    {
        return view('auth.login');
    }

    /* Proses login pengguna */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            } else {
                return redirect()->route('user.dashboard')->with('success', 'Login berhasil!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /* Logout pengguna dari sistem */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    /* Tampilkan daftar user (khusus admin) */
    public function adminUsersIndex()
    {
        try {
            if (! Auth::check() || Auth::user()->role !== 'admin') {
                abort(403);
            }

            $users = User::where('id', '!=', Auth::id())->latest()->get();

            return view('admin.users.index', compact('users'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data user: '.$e->getMessage());
        }
    }

    /**
     * Form tambah user (admin only)
     */
    public function adminUsersCreate()
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.users.create');
    }

    /**
     * Simpan user baru (admin only)
     */
    public function adminUsersStore(Request $request)
    {
        try {
            if (! Auth::check() || Auth::user()->role !== 'admin') {
                abort(403);
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'role' => 'required|in:admin,pengguna',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // FIX: Redirect ke CREATE dengan success message
            return redirect()->route('admin.users.create')
                ->with('success', 'User berhasil ditambahkan!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambah user: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Form edit user (admin only)
     */
    public function adminUsersEdit(User $user)
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user (admin only)
     */
    public function adminUsersUpdate(Request $request, User $user)
    {
        try {
            if (! Auth::check() || Auth::user()->role !== 'admin') {
                abort(403);
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'password' => 'nullable|string|min:6|confirmed',
                'role' => 'required|in:admin,pengguna',
            ]);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ];

            // Update password hanya jika diisi
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            // FIX: Redirect ke EDIT dengan success message
            return redirect()->route('admin.users.edit', $user->id)
                ->with('success', 'User berhasil diupdate!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update user: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Hapus user (admin only)
     */
    public function adminUsersDestroy(User $user)
    {
        try {
            if (! Auth::check() || Auth::user()->role !== 'admin') {
                abort(403);
            }

            // Cek jika user mencoba menghapus diri sendiri
            if ($user->id == Auth::id()) {
                return back()->with('error', 'Tidak dapat menghapus akun sendiri!');
            }

            $user->delete();

            // FIX: Pastikan route name benar
            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil dihapus!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus user: '.$e->getMessage());
        }
    }
}
