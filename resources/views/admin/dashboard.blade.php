@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Selamat datang, {{ Auth::user()->name }}!</h1>
        </div>
    </div>

    <!-- Statistics Cards - Satu Baris -->
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
                        <i class="fas fa-exchange-alt fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">{{ $activeBorrows }}</h3>
                    <p class="card-text">Peminjaman Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-clock fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">{{ $overdueBorrows }}</h3>
                    <p class="card-text">Keterlambatan</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-check-circle fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">0</h3>
                    <p class="card-text">Telah Dikembalikan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title" style="color: #8B4513;">
                        <i class="fas fa-history me-2"></i>Aktivitas Terbaru
                    </h5>
                    <div class="list-group list-group-flush">
                        @if($recentActivities->count() > 0)
                            @foreach($recentActivities as $activity)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                    <p class="mb-0">
                                        {{ $activity->user->name }} meminjam "{{ $activity->book->title }}"
                                    </p>
                                </div>
                                <span class="badge" style="background-color: #8B4513;">
                                    {{ ucfirst($activity->status) }}
                                </span>
                            </div>
                            @endforeach
                        @else
                            <div class="list-group-item text-center py-4">
                                <p class="text-muted mb-0">Belum ada aktivitas peminjaman</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title" style="color: #8B4513;">
                        <i class="fas fa-exclamation-triangle me-2"></i>Peringatan
                    </h5>
                    <div class="list-group list-group-flush">
                        @if($warnings->count() > 0)
                            @foreach($warnings as $warning)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        {{ $warning->user->name }} - "{{ $warning->book->title }}"
                                        <br>
                                        <small class="text-muted">
                                            Jatuh tempo: {{ $warning->return_date->format('d/m/Y') }}
                                        </small>
                                    </span>
                                    <span class="badge bg-danger">Terlambat</span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="list-group-item text-center py-4">
                                <p class="text-muted mb-0">Tidak ada peringatan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection