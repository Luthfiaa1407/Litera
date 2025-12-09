<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->get();

        // AUTO RETURN jika overdue
        foreach ($borrows as $borrow) {

            if (
                in_array($borrow->status, ['approved', 'active']) &&
                $borrow->return_date !== null &&
                Carbon::parse($borrow->return_date)->isPast()
            ) {
                $borrow->update([
                    'status' => 'auto_returned',
                    'return_date' => now(),
                ]);

                $borrow->book->increment('stock');
            }
        }

        return view('user.borrows.index', compact('borrows'));
    }

    public function create(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        return view('user.borrows.create', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        // CEGAH double request (pending BUKAN status aktif)
        $cek = Borrow::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['approved', 'active'])
            ->first();

        if ($cek) {
            return back()->with('error', 'Anda masih memiliki peminjaman aktif untuk buku ini.');
        }

        Borrow::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Permintaan peminjaman berhasil diajukan.');
    }

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
        if ($borrow->user_id !== Auth::id()) {
            abort(403);
        }

        $borrow->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        $borrow->book->increment('stock');

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
