@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4" style="color: #8B4513;" class="lead">Selamat datang, <strong>{{ Auth::user()->name }}</strong></h1>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-users fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">{{ $totalUsers }}</h3>
                    <p class="card-text">Total Pengguna</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-shield fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">{{ $totalAdmins }}</h3>
                    <p class="card-text">Total Admin</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-book fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">{{ $totalBooks }}</h3>
                    <p class="card-text">Total Buku</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-clock fa-2x text-warning"></i>
                    </div>
                    <h3 class="card-title text-warning">{{ $pendingRequests }}</h3>
                    <p class="card-text">Menunggu Approval</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-exchange-alt fa-2x text-primary"></i>
                    </div>
                    <h3 class="card-title text-primary">{{ $activeBorrows }}</h3>
                    <p class="card-text">Sedang Dipinjam</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                    <h3 class="card-title text-success">{{ $approvedRequests }}</h3>
                    <p class="card-text">Telah Disetujui</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Pending Approvals -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0" style="color: #8B4513;">
                            <i class="fas fa-clock me-2"></i>Permohonan Pending
                        </h5>
                        <a href="#" class="btn btn-sm" style="background-color: #8B4513; color: white;">
                            Lihat Semua
                        </a>
                    </div>
                    
                    <div class="list-group list-group-flush">
                        @if($pendingApprovals->count() > 0)
                            @foreach($pendingApprovals->take(5) as $approval)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $approval->user->name }}</h6>
                                    <p class="mb-1 small text-muted">
                                        <i class="fas fa-book me-1"></i>{{ $approval->book->title }}
                                    </p>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $approval->borrow_date->format('d/m/Y') }} - {{ $approval->return_date->format('d/m/Y') }}
                                    </small>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted d-block">{{ $approval->request_date->diffForHumans() }}</small>
                                    <div class="btn-group btn-group-sm mt-1">
                                        <form action="#" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $approval->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Reject Modal -->
                            <div class="modal fade" id="rejectModal{{ $approval->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tolak Permohonan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="#" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p><strong>User:</strong> {{ $approval->user->name }}</p>
                                                <p><strong>Buku:</strong> {{ $approval->book->title }}</p>
                                                <div class="mb-3">
                                                    <label for="admin_notes" class="form-label">Alasan Penolakan</label>
                                                    <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3" required placeholder="Berikan alasan penolakan..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Tolak Permohonan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="list-group-item text-center py-4">
                                <i class="fas fa-check-circle fa-2x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Tidak ada permohonan pending</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3" style="color: #8B4513;">
                        <i class="fas fa-history me-2"></i>Aktivitas Terbaru
                    </h5>
                    <div class="list-group list-group-flush">
                        @if($recentActivities->count() > 0)
                            @foreach($recentActivities as $activity)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $activity->user->name }}</h6>
                                    <p class="mb-1 small text-muted">
                                        <i class="fas fa-book me-1"></i>{{ $activity->book->title }}
                                    </p>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $activity->borrow_date->format('d/m/Y') }} - {{ $activity->return_date->format('d/m/Y') }}
                                    </small>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted d-block">{{ $activity->updated_at->diffForHumans() }}</small>
                                    <span class="badge 
                                        @if($activity->status == 'pending') bg-warning
                                        @elseif($activity->status == 'approved') bg-info
                                        @elseif($activity->status == 'active') bg-primary
                                        @elseif($activity->status == 'returned') bg-success
                                        @elseif($activity->status == 'rejected') bg-danger
                                        @elseif($activity->status == 'auto_returned') bg-secondary
                                        @endif">
                                        {{ ucfirst($activity->status) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="list-group-item text-center py-4">
                                <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada aktivitas peminjaman</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection