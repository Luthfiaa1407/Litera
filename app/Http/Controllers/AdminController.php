<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        try {
            $user = Auth::user();

            // AUTO RETURN: Cek dan proses buku yang sudah lewat tanggal kembali
            $overdueBorrows = Borrow::where('status', 'active')
                ->whereDate('return_date', '<', now()->toDateString())
                ->get();

            foreach ($overdueBorrows as $borrow) {
                // Kembalikan stok buku
                $borrow->book->increment('stock');

                // Update status ke auto_returned
                $borrow->update([
                    'status' => 'auto_returned',
                ]);
            }

            $totalUsers = User::where('role', 'pengguna')->count();
            $totalAdmins = User::where('role', 'admin')->count();
            $totalBooks = Book::count();

            // Statistik baru berdasarkan sistem approval
            $pendingRequests = Borrow::pending()->count();
            $activeBorrows = Borrow::active()->count();
            $approvedRequests = Borrow::approved()->count();
            $autoReturnedCount = Borrow::where('status', 'auto_returned')->count();

            // Aktivitas terbaru
            $recentActivities = Borrow::with('user', 'book')
                ->latest()
                ->take(5)
                ->get();

            // Peringatan - sekarang untuk request pending yang butuh approval
            $pendingApprovals = Borrow::pending()
                ->with('user', 'book')
                ->get();

            return view('admin.dashboard', compact(
                'user',
                'totalUsers',
                'totalAdmins',
                'totalBooks',
                'pendingRequests',
                'activeBorrows',
                'approvedRequests',
                'autoReturnedCount',
                'recentActivities',
                'pendingApprovals'
            ));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memuat dashboard: '.$e->getMessage()]);
        }
    }

    public function approve($id)
    {
        $borrow = Borrow::findOrFail($id);

        // Jika hari ini >= return_date → auto return
        if (now()->toDateString() >= $borrow->return_date) {

            // Kembalikan stok buku
            $borrow->book->increment('stock');

            // Update status ke auto_returned
            $borrow->update([
                'status' => 'auto_returned',
                'approved_by' => Auth::id(),
                'approved_date' => now(),
            ]);

            return back()->with('success', 'Peminjaman sudah melewati tanggal kembali. Buku otomatis dikembalikan.');
        }

        // NORMAL APPROVE (jika belum jatuh tempo)
        $borrow->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_date' => now(),
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui.');
    }
}
