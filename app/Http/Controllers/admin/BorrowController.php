<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    // Admin: Tampilkan request pending
    public function pendingRequests()
    {
        $pendingBorrows = Borrow::pending()
            ->with(['user', 'book'])
            ->latest()
            ->get();

        return view('admin.borrows.pending', compact('pendingBorrows'));
    }

    // Admin: Approve request
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

        $borrow->book->decrement('stock');

        return back()->with('success', 'Peminjaman disetujui.');
    }

    // Admin: Reject request
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

        return back()->with('success', 'Peminjaman ditolak.');
    }

    // Admin: Konfirmasi buku diambil
    public function confirmBorrow(Borrow $borrow)
    {
        if ($borrow->status !== 'approved') {
            return back()->withErrors(['error' => 'Hanya peminjaman yang sudah disetujui yang bisa dikonfirmasi.']);
        }

        $borrow->update([
            'status' => 'active',
        ]);

        return back()->with('success', 'Status peminjaman berubah menjadi aktif.');
    }

    // Admin: Konfirmasi pengembalian
    public function confirmReturn(Borrow $borrow)
    {
        if ($borrow->status !== 'active') {
            return back()->withErrors(['error' => 'Hanya peminjaman aktif yang bisa dikembalikan.']);
        }

        $borrow->book->increment('stock');

        $borrow->update([
            'status' => 'returned',
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
