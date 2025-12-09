<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil peminjaman yang sudah disetujui / aktif
        $active_borrows = $user->borrowings()
            ->whereIn('status', ['approved', 'active', 'dipinjam'])
            ->with('book')
            ->get();

        // Jumlah peminjaman aktif
        $active_count = $active_borrows->count();

        // Hitung sisa hari terdekat
        $days_left = null;
        if ($active_borrows->isNotEmpty()) {
            $nearest = $active_borrows
                ->filter(fn($b) => !empty($b->return_date))
                ->sortBy('return_date')
                ->first();

            if ($nearest && $nearest->return_date) {
                $days_left = now()->diffInDays(Carbon::parse($nearest->return_date), false);
                if ($days_left < 0) $days_left = 0;
            }
        }

        // Total buku
        $books_count = Book::count();

        // Buku tersedia
        $available_books = Book::latest()->take(6)->get();

        return view('user.dashboard', compact(
            'user',
            'active_borrows',
            'active_count',
            'days_left',
            'books_count',
            'available_books'
        ));
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
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.profile.index')
            ->with('success', 'Profile berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'password'         => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.profile.index')
            ->with('success', 'Password berhasil diperbarui!');
    }

    public function books()
    {
        $books = Book::where('stock', '>', 0)->paginate(12);
        return view('user.books.index', compact('books'));
    }

    public function showBook(Book $book)
    {
        return view('user.book-detail', compact('book'));
    }
}
