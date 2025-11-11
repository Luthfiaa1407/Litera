<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;

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
            return back()->withErrors(['error' => 'Gagal memuat dashboard: ' . $e->getMessage()]);
        }
    }
}