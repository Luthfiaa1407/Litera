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
            ->latest()
            ->get();

        return view('user.borrows.index', compact('borrows'));
    }

    // Form ajukan peminjaman (optional ?book_id=)
    public function create(Request $request)
    {
        $bookId = $request->get('book_id');

        $book = Book::findOrFail($bookId);

        return view('user.borrows.create', compact('book'));
    }

    // Store peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < 1) {
            return back()->withErrors(['error' => 'Buku tidak tersedia untuk dipinjam.'])->withInput();
        }

        $existingBorrow = Borrow::where('user_id', Auth::id())
            ->where('book_id', $request->book_id)
            ->whereIn('status', ['pending', 'approved', 'active'])
            ->first();

        if ($existingBorrow) {
            return back()->withErrors(['error' => 'Anda sudah mengajukan peminjaman untuk buku ini.'])->withInput();
        }

        $borrow = Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'pending',
            'request_date' => now(),
        ]);

        return redirect()->route('user.borrows.index')
                     ->with('success', 'Permintaan peminjaman berhasil diajukan dan menunggu persetujuan admin.');
    }

    // (optional) show single borrow detail for user
    public function show(Borrow $borrow)
    {
        $this->authorize('view', $borrow); // optional: add policy to ensure owner
        $borrow->load('book', 'user', 'admin');
        return view('user.borrows.show', compact('borrow'));
    }
}
