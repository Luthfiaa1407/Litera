<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Book;
use App\Models\Borrow;

class UserController extends Controller
{
    public function dashboard()
    {
        try {
            $user = Auth::user();
            
            // Pastikan user sudah login
            if (!$user) {
                return redirect()->route('login');
            }

            // Ambil data peminjaman aktif user
            $active_borrows = $user->borrowings()
                ->whereIn('status', ['active', 'dipinjam'])
                ->with('book')
                ->get();

            // Hitung sisa hari peminjaman
            $days_left = null;
            if ($active_borrows->isNotEmpty()) {
                $nearest = $active_borrows->filter(function($b) {
                    return !is_null($b->return_date);
                })->sortBy('return_date')->first();

                if ($nearest && $nearest->return_date) {
                    $returnDate = \Carbon\Carbon::parse($nearest->return_date);
                    $days_left = now()->diffInDays($returnDate, false);
                    // Jika sudah lewat, set ke 0
                    if ($days_left < 0) {
                        $days_left = 0;
                    }
                }
            }

            // Total buku
            $books_count = Book::count();

            // Buku tersedia
            $available_books = Book::where('stock', '>', 0)->take(6)->get();

            return view('user.dashboard', compact(
                'user',
                'active_borrows',
                'days_left',
                'books_count',
                'available_books'
            ));

        } catch (\Exception $e) {
            // Fallback jika ada error
            return view('user.dashboard', [
                'user' => Auth::user(),
                'active_borrows' => collect(),
                'days_left' => null,
                'books_count' => 0,
                'available_books' => collect(),
            ])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    public function editProfile()
{
    $user = Auth::user();
    return view('user.profile.edit', compact('user'));
}
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->route('user.profile.index')
                ->with('success', 'Profile berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui profile: ' . $e->getMessage());
        }
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Cek password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        try {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('user.profile.index')
                ->with('success', 'Password berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui password: ' . $e->getMessage());
        }
    }
}