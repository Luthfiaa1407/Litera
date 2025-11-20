<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Dashboard untuk USER (pengguna biasa)
     */
    public function dashboard()
{
    $user = auth()->user();

    // ambil peminjaman aktif user (status sesuai yang kamu pakai: 'active' atau 'dipinjam')
    // sesuaikan 'active' dengan value status di tabel kamu; saya gunakan 'active' dan 'dipinjam' sebagai fallback
    $activeBorrows = $user->borrowings()
        ->whereIn('status', ['active', 'dipinjam'])
        ->with('book')
        ->get();

    // hitung sisa hari paling dekat (menggunakan kolom return_date)
    $days_left = null;
    if ($activeBorrows->isNotEmpty()) {
        // ambil peminjaman dengan return_date paling dekat ke sekarang (future / past)
        $nearest = $activeBorrows->filter(function($b) {
            return !is_null($b->return_date);
        })->sortBy(function($b) {
            return $b->return_date;
        })->first();

        if ($nearest && $nearest->return_date) {
            $returnDate = \Carbon\Carbon::parse($nearest->return_date);
            // diffInDays dengan signed result (negatif kalau lewat)
            $days_left = now()->diffInDays($returnDate, false);
            // kalau mau selalu non-negatif: $days_left = max(0, $days_left);
        }
    }

    // total buku (model Book)
    $books_count = \App\Models\Book::count();

    // buku tersedia (sesuaikan kondisi kolom yang kamu pakai untuk ketersediaan)
    // contoh: ambil buku yang stok > 0 atau yang tidak sedang dipinjam
    // jika kamu tidak punya kolom stok, pakai all()->take(6)
    $available_books = \App\Models\Book::where(function($q){
            if (\Schema::hasColumn('books', 'stock')) {
                $q->where('stock', '>', 0);
            }
        })->take(6)->get();

    return view('user.dashboard', [
        'user' => $user,
        'active_borrows' => $activeBorrows,
        'days_left' => $days_left,
        'books_count' => $books_count,
        'available_books' => $available_books,
    ]);
}

    /**
     * ADMIN - Tampilkan semua user
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * ADMIN - Form tambah user
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * ADMIN - Simpan user baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'in:admin,pengguna'],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * ADMIN - Form edit user
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * ADMIN - Update user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'role'     => ['required', 'in:admin,pengguna'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.user.edit', $user->id)
            ->with('success', 'User berhasil diupdate!');
    }

    /**
     * ADMIN - Hapus user
     */
    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {
            return redirect()->route('admin.user.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', "User '$name' berhasil dihapus!");
    }
}
