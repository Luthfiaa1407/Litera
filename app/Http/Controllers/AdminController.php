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
            // Ambil data statistik dari database
            $totalUsers = User::where('role', 'pengguna')->count();
            $totalAdmins = User::where('role', 'admin')->count();
            $totalBooks = Book::count();
            $activeBorrows = Borrow::where('status', 'dipinjam')->count();
            $overdueBorrows = Borrow::where('status', 'terlambat')->count();

            // Ambil aktivitas terbaru
            $recentActivities = Borrow::with('user', 'book')
                ->latest()
                ->take(5)
                ->get();

            // Ambil peringatan
            $warnings = Borrow::where('status', 'terlambat')
                ->orWhere('return_date', '<', now())
                ->with('user', 'book')
                ->get();

            return view('admin.dashboard', compact(
                'totalUsers',
                'totalAdmins', 
                'totalBooks',
                'activeBorrows',
                'overdueBorrows',
                'recentActivities',
                'warnings'
            ));
        } catch (\Exception $e) {
            // JANGAN redirect ke admin.dashboard di sini, itu menyebabkan loop
            return back()->withErrors(['error' => 'Gagal memuat dashboard: ' . $e->getMessage()]);
        }
    }
}