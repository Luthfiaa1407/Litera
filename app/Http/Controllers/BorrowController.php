<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrow;
use App\Models\Book;

class BorrowController extends Controller
{
    // Tampilkan peminjaman user
    public function index()
    {
        $borrows = Borrow::where('user_id', Auth::id())
            ->with('book')
            ->latest()
            ->get();
            
        return view('user.borrows.index', compact('borrows'));
    }

    // Form ajukan peminjaman
    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('user.borrows.create', compact('books'));
    }

    // Ajukan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        $book = Book::findOrFail($request->book_id);
        
        // Cek stok buku
        if ($book->stock < 1) {
            return back()->withErrors(['error' => 'Buku tidak tersedia untuk dipinjam.']);
        }

        // Cek apakah user sudah meminjam buku yang sama dan belum kembali
        $existingBorrow = Borrow::where('user_id', Auth::id())
            ->where('book_id', $request->book_id)
            ->whereIn('status', ['pending', 'approved', 'active'])
            ->first();

        if ($existingBorrow) {
            return back()->withErrors(['error' => 'Anda sudah mengajukan peminjaman untuk buku ini.']);
        }

        Borrow::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'pending',
            'request_date' => now(),
        ]);

        return redirect()->route('user.borrows.index')->with('success', 'Permohonan peminjaman berhasil diajukan! Menunggu persetujuan admin.');
    }
}