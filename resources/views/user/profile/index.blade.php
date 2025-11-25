@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f5f3f0;
            font-family: 'Georgia', serif;
        }
        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-top: 5px solid #8B4513;
            overflow: hidden;
        }
        .profile-header {
            background: linear-gradient(135deg, #8B4513, #A0522D);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            border: 4px solid white;
        }
        .profile-avatar i {
            font-size: 2.5rem;
            color: #8B4513;
        }
        .info-section {
            padding: 2rem;
        }
        .stats-section {
            background: #f8f9fa;
            padding: 2rem;
            border-top: 1px solid #e9ecef;
        }
        .stat-item {
            text-align: center;
            padding: 1rem;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #8B4513;
        }
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .btn-edit {
            background-color: #8B4513;
            border-color: #8B4513;
            color: white;
        }
        .btn-edit:hover {
            background-color: #6d3b0f;
            border-color: #6d3b0f;
        }
        .btn-logout {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .btn-logout:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .info-row {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
    </style>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card">
                    <!-- Header -->
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3>{{ $user->name }}</h3>
                        <p class="mb-0">{{ $user->email }}</p>
                        <span class="badge bg-light text-dark mt-2">
                            {{ $user->role === 'admin' ? 'Administrator' : 'Pengguna' }}
                        </span>
                    </div>

                    <!-- Informasi Profile -->
                    <div class="info-section">
                        <h5 class="mb-4" style="color: #8B4513;">
                            <i class="fas fa-user-circle me-2"></i>Informasi Profile
                        </h5>
                        
                        <div class="info-row">
                            <strong>Nama Lengkap:</strong>
                            <p class="mb-0">{{ $user->name }}</p>
                        </div>
                        
                        <div class="info-row">
                            <strong>Email:</strong>
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                        
                        <div class="info-row">
                            <strong>Bergabung sejak:</strong>
                            <p class="mb-0">{{ $user->created_at->format('d F Y') }}</p>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('user.profile.edit') }}" class="btn btn-edit me-2">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </a>
                            <a href="{{ route('logout') }}" class="btn btn-logout" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                           </a>
                        </div>
                    </div>

                    <div class="stats-section">
                        <h5 class="mb-4" style="color: #8B4513;">
                            <i class="fas fa-chart-bar me-2"></i>Statistik Peminjaman
                        </h5>
                        
                        <div class="row text-center">
                            <div class="col-md-4 stat-item">
                                <div class="stat-number">{{ $total_peminjaman ?? 0 }}</div>
                                <div class="stat-label">Total Peminjaman</div>
                            </div>
                            <div class="col-md-4 stat-item">
                                <div class="stat-number">{{ $peminjaman_aktif ?? 0 }}</div>
                                <div class="stat-label">Peminjaman Aktif</div>
                            </div>
                            <div class="col-md-4 stat-item">
                                <div class="stat-number">{{ $riwayat_peminjaman ?? 0 }}</div>
                                <div class="stat-label">Riwayat Peminjaman</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection