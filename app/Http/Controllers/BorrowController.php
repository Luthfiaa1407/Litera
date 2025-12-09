<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrow;
use App\Models\Book;

class BorrowController extends Controller
{
    // List semua peminjaman milik user
    public function index()
    {
        $borrows = Borrow::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.borrows.index', compact('borrows'));
    }

    // Form ajukan peminjaman
    public function create(Request $request)
    {
        $bookId = $request->get('book_id');
        $book = Book::findOrFail($bookId);

        return view('user.borrows.create', compact('book'));
    }

    // Simpan permintaan peminjaman (PENDING)
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        $book = Book::find($request->book_id);

        if ($book->stock <= 0) {
            return back()->with('error', 'Maaf, stok buku habis.');
        }

        // Cegah double request
        $activeStatuses = ['pending', 'approved', 'active'];
        $cek = Borrow::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', $activeStatuses) // ✅ Gunakan whereIn
            ->first();

        if ($cek) {
            return back()->with('error', 'Anda masih memiliki peminjaman/permintaan aktif untuk buku ini (Status: ' . ucfirst($cek->status) . ').');
        }

        // Simpan sebagai PENDING
        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => $request->borrow_date, // Ambil dari form
            'due_date' => $request->return_date,  // Ambil dari form
            'status' => 'pending', // Status pinjaman baru
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Permintaan pinjam buku berhasil diajukan! Menunggu persetujuan Admin.');
    }

    // Detail peminjaman
    public function show(Borrow $borrow)
    {
        if ($borrow->user_id !== Auth::id()) {
            abort(403);
        }

        $borrow->load('book');

        return view('user.borrows.show', compact('borrow'));
    }

    public function return(Borrow $borrow)
{
    // Pastikan hanya pemilik yang bisa kembalikan
    if ($borrow->user_id !== Auth::id()) {
        abort(403);
    }

    // Update status peminjaman
    $borrow->update([
        'status' => 'returned',
        'returned_at' => now(),
    ]);

    // Tambah stok buku
    $borrow->book->increment('stock');

    return back()->with('success', 'Buku berhasil dikembalikan.');
}


}
