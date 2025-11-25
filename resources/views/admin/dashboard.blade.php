@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #8B4513;">Dashboard Admin</h2>
    </div>

    <!-- Quick Stats -->
    <div class="row">

        <!-- Pending Requests -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-hourglass-half fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Pending</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $pendingRequests ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Active Borrows -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-book-reader fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Dipinjam</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $activeBorrows ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Approved Requests -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-check-circle fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Disetujui</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $approvedRequests ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-users fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Users</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $totalUsers ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Buku -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-book fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Total Buku</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $totalBooks ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.categories.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-tags fa-2x" style="color: #8B4513;"></i>
                        </div>
                        <h3 class="card-title" style="color: #8B4513;">Kelola</h3>
                        <p class="card-text" style="color: #8B4513;">Kategori</p>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <!-- Pending Approvals -->
    @if(isset($pendingApprovals) && $pendingApprovals->count() > 0)
    <div class="mt-4">
        <div class="alert alert-warning">
            <h5 class="alert-heading">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Peringatan: Ada {{ $pendingApprovals->count() }} permohonan peminjaman yang menunggu persetujuan!
            </h5>
            <a href="{{ route('admin.borrows.pending') }}" class="btn btn-warning btn-sm mt-2">
                <i class="fas fa-list me-1"></i>Lihat Permohonan Pending
            </a>
        </div>
    </div>
    @endif

    <!-- Riwayat Aktivitas Terbaru -->
    <div class="mt-5">
        <h4 class="fw-bold" style="color: #8B4513;">Aktivitas Terbaru</h4>
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">

                @if(isset($recentActivities) && $recentActivities->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentActivities as $activity)
                            <tr>
                                <td>{{ $activity->user->name ?? 'N/A' }}</td>
                                <td>{{ $activity->book->title ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($activity->status == 'pending') bg-warning
                                        @elseif($activity->status == 'active') bg-primary
                                        @elseif($activity->status == 'approved') bg-info
                                        @elseif($activity->status == 'returned') bg-success
                                        @elseif($activity->status == 'rejected') bg-danger
                                        @else bg-secondary @endif">
                                        {{ ucfirst($activity->status) }}
                                    </span>
                                </td>
                                <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Belum ada aktivitas terbaru.</p>
                @endif

            </div>
        </div>
    </div>

</div>
@endsection