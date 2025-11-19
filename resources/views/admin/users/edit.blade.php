@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 bg-transparent pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 style="color: #8B4513;">
                            <i class="fas fa-edit me-2"></i>Edit User
                        </h3>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label" style="color: #8B4513;">
                                        <i class="fas fa-user me-1"></i>Nama Lengkap
                                    </label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name', $user->name) }}"
                                           required
                                           placeholder="Masukkan nama lengkap">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label" style="color: #8B4513;">
                                        <i class="fas fa-envelope me-1"></i>Email
                                    </label>
                                    <input type="email"
                                           class="form-control bg-light"
                                           id="email"
                                           value="{{ $user->email }}"
                                           disabled
                                           placeholder="Email tidak dapat diubah">
                                    <input type="hidden" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label" style="color: #8B4513;">
                                        <i class="fas fa-lock me-1"></i>Password Baru
                                    </label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           placeholder="Kosongkan jika tidak ingin mengubah">
                                    <small class="form-text text-muted">
                                        Biarkan kosong jika tidak ingin mengubah password
                                    </small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label" style="color: #8B4513;">
                                        <i class="fas fa-lock me-1"></i>Konfirmasi Password Baru
                                    </label>
                                    <input type="password"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="Konfirmasi password baru">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label class="form-label" style="color: #8B4513;">
                                <i class="fas fa-user-tag me-1"></i>Role
                            </label>
                            <div class="form-control bg-light">
                              {{ ucfirst($user->role) }}
                            </div>
                            <input type="hidden" name="role" value="{{ $user->role }}">
                        </div>

                        <!-- Informasi User (Tanpa Card) -->
                        <div class="mb-4">
                            <h6 class="mb-2" style="color: #8B4513;">
                                <i class="fas fa-info-circle me-1"></i>Informasi User
                            </h6>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Email:</small><br>
                                    <strong>{{ $user->email }}</strong>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Role:</small><br>
                                        {{ ucfirst($user->role) }}
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Dibuat:</small><br>
                                    <strong>{{ $user->created_at->format('d/m/Y H:i') }}</strong>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Diupdate:</small><br>
                                    <strong>{{ $user->updated_at->format('d/m/Y H:i') }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn" style="background-color: #8B4513; color: white;">
                                <i class="fas fa-save me-1"></i>Update User
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reset password fields setelah update berhasil
        document.getElementById('password').value = '';
        document.getElementById('password_confirmation').value = '';
        
        // Auto hide success alert setelah 5 detik
        setTimeout(function() {
            const alert = document.getElementById('successAlert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }
        }, 5000);
    });
</script>
@endif
@endsection

@section('styles')
<style>
    .card {
        border-radius: 10px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
    }

    .btn {
        border-radius: 6px;
    }

    .bg-light {
        background-color: #f8f9fa !important;
        border: 1px solid #e9ecef;
    }

    /* Disabled fields */
    .form-control:disabled,
    .form-select:disabled {
        background-color: #f8f9fa;
        color: #6c757d;
        cursor: not-allowed;
    }
</style>
@endsection