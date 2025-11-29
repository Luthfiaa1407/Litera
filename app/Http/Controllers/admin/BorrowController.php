<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    // ============================
    // 1. TAMPILKAN PENDING REQUEST
    // ============================
    public function pending()
    {
        $pendingBorrows = Borrow::with(['user', 'book'])
            ->where('status', 'pending')
            ->orderBy('request_date', 'desc')
            ->get();

        return view('admin.borrows.pending', compact('pendingBorrows'));
    }

    // ============================
    // 2. APPROVE REQUEST
    // ============================
    public function approve($id)
    {
        $borrow = Borrow::findOrFail($id);

        // Kurangi stok buku ketika approved
        $book = $borrow->book;

        if ($book->stock <= 0) {
            return back()->withErrors(['Stok buku habis!']);
        }

        $book->stock -= 1;
        $book->save();

        // Update status borrowing
        $borrow->status = 'approved';
        $borrow->approved_by = Auth::id();
        $borrow->approved_date = now();
        $borrow->save();

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    // ============================
    // 3. REJECT REQUEST
    // ============================
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500',
        ]);

        $borrow = Borrow::findOrFail($id);

        $borrow->status = 'rejected';
        $borrow->admin_notes = $request->admin_notes;
        $borrow->approved_by = Auth::id();
        $borrow->approved_date = now();
        $borrow->save();

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }
}
