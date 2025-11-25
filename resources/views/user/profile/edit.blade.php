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
        padding: 1.5rem;
        text-align: center;
    }
    .btn-primary {
        background-color: #8B4513;
        border-color: #8B4513;
    }
    .btn-primary:hover {
        background-color: #6d3b0f;
        border-color: #6d3b0f;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .form-control:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139,69,19,0.15);
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card">
                <!-- Header -->
                <div class="profile-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </h4>
                </div>

                <!-- Form Edit Profile -->
                <div class="p-4">
                    <!-- Notifications -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mb-4">
                        <a href="{{ route('user.profile.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    <!-- Edit Profile Form -->
                    <form method="POST" action="{{ route('user.profile.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection