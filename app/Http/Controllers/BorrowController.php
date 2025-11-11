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

    // Admin: Tampilkan request pending
    public function pendingRequests()
    {
        $pendingBorrows = Borrow::pending()
            ->with(['user', 'book'])
            ->latest()
            ->get();
            
        return view('admin.borrows.pending', compact('pendingBorrows'));
    }

    // Admin: Approve peminjaman
    public function approve(Borrow $borrow)
    {
        if ($borrow->status !== 'pending') {
            return back()->withErrors(['error' => 'Permohonan ini sudah diproses.']);
        }

        if ($borrow->book->stock < 1) {
            return back()->withErrors(['error' => 'Stok buku tidak mencukupi.']);
        }

        $borrow->update([
            'status' => 'approved',
            'approved_date' => now(),
            'approved_by' => Auth::id(),
        ]);

        // Kurangi stok buku
        $borrow->book->decrement('stock');

        return back()->with('success', 'Peminjaman disetujui! Stok buku dikurangi.');
    }

    // Admin: Reject peminjaman
    public function reject(Request $request, Borrow $borrow)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500',
        ]);

        if ($borrow->status !== 'pending') {
            return back()->withErrors(['error' => 'Permohonan ini sudah diproses.']);
        }

        $borrow->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'approved_date' => now(),
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Peminjaman ditolak!');
    }

    // Admin: Konfirmasi buku sudah diambil (setelah approval)
    public function confirmBorrow(Borrow $borrow)
    {
        if ($borrow->status !== 'approved') {
            return back()->withErrors(['error' => 'Hanya peminjaman yang sudah disetujui yang bisa dikonfirmasi.']);
        }

        $borrow->update([
            'status' => 'active',
        ]);

        return back()->with('success', 'Buku berhasil dipinjamkan! Status diubah menjadi aktif.');
    }

    // Admin: Konfirmasi pengembalian
    public function confirmReturn(Borrow $borrow)
    {
        if ($borrow->status !== 'active') {
            return back()->withErrors(['error' => 'Hanya peminjaman aktif yang bisa dikembalikan.']);
        }

        // Tambah stok buku
        $borrow->book->increment('stock');

        $borrow->update([
            'status' => 'returned',
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan! Stok buku ditambah.');
    }
}