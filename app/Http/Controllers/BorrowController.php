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
            'book_id'     => 'required|exists:books,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < 1) {
            return back()->withErrors(['error' => 'Stok buku habis.'])->withInput();
        }

        // Cegah double request
        $alreadyRequested = Borrow::where('user_id', Auth::id())
            ->where('book_id', $request->book_id)
            ->whereIn('status', ['pending', 'approved', 'active'])
            ->exists();

        if ($alreadyRequested) {
            return back()->withErrors(['error' => 'Anda sudah mengajukan peminjaman untuk buku ini.']);
        }

        // Simpan sebagai PENDING
        Borrow::create([
            'user_id'      => Auth::id(),
            'book_id'      => $request->book_id,
            'borrow_date'  => $request->borrow_date,
            'return_date'  => $request->return_date,
            'status'       => 'pending',
            'request_date' => now(),
        ]);

        return redirect()->route('user.borrows.index')
            ->with('success', 'Permohonan berhasil dikirim dan menunggu persetujuan admin.');
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
