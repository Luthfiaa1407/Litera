@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 style="color: #8B4513;">
                    <i class="fas fa-users me-2"></i>Kelola Pengguna
                </h1>
                <a href="{{ route('admin.users.create') }}" class="btn" style="background-color: #8B4513; color: white;">
                    <i class="fas fa-plus me-1"></i>Tambah User
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background-color: #f5f3f0;">
                            <tr>
                                <th style="color: #8B4513;">#</th>
                                <th style="color: #8B4513;">Nama</th>
                                <th style="color: #8B4513;">Email</th>
                                <th style="color: #8B4513;">Role</th>
                                <th style="color: #8B4513;">Tanggal Dibuat</th>
                                <th style="color: #8B4513;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 40px; height: 40px; background-color: #8B4513; color: white;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $user->name }}</strong>
                                            @if($user->id == Auth::id())
                                                <span class="badge bg-info ms-1">Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="text-dark 
                                        @if($user->role == 'admin') 
                                        @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           class="btn btn-outline-primary" 
                                           title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        @if($user->id != Auth::id())
                                            <button type="button" 
                                                    class="btn btn-outline-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $user->id }}"
                                                    title="Hapus User">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @else
                                            <button type="button" 
                                                    class="btn btn-outline-secondary" 
                                                    disabled
                                                    title="Tidak dapat menghapus akun sendiri">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Delete Modal -->
                                    @if($user->id != Auth::id())
                                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger">
                                                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus user ini?</p>
                                                    <div class="alert alert-warning">
                                                        <strong>Data yang akan dihapus:</strong><br>
                                                        <strong>Nama:</strong> {{ $user->name }}<br>
                                                        <strong>Email:</strong> {{ $user->email }}<br>
                                                        <strong>Role:</strong> {{ ucfirst($user->role) }}
                                                    </div>
                                                    <p class="text-danger">
                                                        <small>
                                                            <i class="fas fa-info-circle me-1"></i>
                                                            Tindakan ini tidak dapat dibatalkan!
                                                        </small>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash me-1"></i>Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada user terdaftar</h4>
                    <p class="text-muted">Mulai dengan menambahkan user baru</p>
                    <a href="{{ route('admin.users.create') }}" class="btn" style="background-color: #8B4513; color: white;">
                        <i class="fas fa-plus me-1"></i>Tambah User Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@if(session('success') || session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto hide alerts setelah 5 detik
        setTimeout(function() {
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');
            
            if (successAlert) {
                successAlert.style.transition = 'opacity 0.5s';
                successAlert.style.opacity = '0';
                setTimeout(function() {
                    successAlert.remove();
                }, 500);
            }
            
            if (errorAlert) {
                errorAlert.style.transition = 'opacity 0.5s';
                errorAlert.style.opacity = '0';
                setTimeout(function() {
                    errorAlert.remove();
                }, 500);
            }
        }, 5000);
    });
</script>
@endif
@endsection

@section('styles')
<style>
    .table th {
        border-bottom: 2px solid #8B4513;
        font-weight: 600;
    }
    
    .table td {
        vertical-align: middle;
        border-color: #f5f3f0;
    }
    
    .btn-group .btn {
        border-radius: 4px;
    }
    
    .alert {
        border: none;
        border-radius: 8px;
    }
</style>
@endsection