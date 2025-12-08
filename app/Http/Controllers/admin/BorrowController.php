<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    // Tampilkan request pending
    public function pending()
    {
        $pendingBorrows = Borrow::with(['user', 'book'])
            ->where('status', 'pending')
            ->orderBy('request_date', 'desc')
            ->get();

        return view('admin.borrows.pending', compact('pendingBorrows'));
    }

    // Approve peminjaman
    public function approve($id)
    {
        $borrow = Borrow::findOrFail($id);

        if ($borrow->status !== 'pending') {
            return back()->withErrors(['error' => 'Permohonan sudah diproses.']);
        }

        $book = $borrow->book;
        if ($book->stock <= 0) {
            return back()->withErrors(['error' => 'Stok buku tidak cukup.']);
        }

        // kurangi stok
        $book->decrement('stock');

        $borrow->status = 'approved';
        $borrow->approved_by = Auth::id();
        $borrow->approved_date = now();
        $borrow->save();

        return back()->with('success', 'Peminjaman disetujui.');
    }

    // Reject peminjaman
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500',
        ]);

        $borrow = Borrow::findOrFail($id);

        if ($borrow->status !== 'pending') {
            return back()->withErrors(['error' => 'Permohonan sudah diproses.']);
        }

        $borrow->status = 'rejected';
        $borrow->admin_notes = $request->admin_notes;
        $borrow->approved_by = Auth::id();
        $borrow->approved_date = now();
        $borrow->save();

        return back()->with('success', 'Peminjaman ditolak.');
    }

    public function confirmBorrow($id)
    {
        $borrow = Borrow::findOrFail($id);
        if ($borrow->status !== 'approved') {
            return back()->withErrors(['error' => 'Hanya peminjaman yang disetujui dapat dikonfirmasi.']);
        }
        $borrow->status = 'active';
        $borrow->save();

        return back()->with('success', 'Status menjadi aktif.');
    }

    public function confirmReturn($id)
    {
        $borrow = Borrow::findOrFail($id);
        if ($borrow->status !== 'active') {
            return back()->withErrors(['error' => 'Hanya peminjaman aktif yang bisa dikembalikan.']);
        }

        $borrow->book->increment('stock');
        $borrow->status = 'returned';
        $borrow->save();

        return back()->with('success', 'Buku dikembalikan dan stok ditambah.');
    }
}
