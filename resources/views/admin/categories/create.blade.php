@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-3" style="color: #8B4513;">Tambah Kategori</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #8B4513;">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" required placeholder="Masukkan nama kategori">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #8B4513;">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Opsional"></textarea>
                </div>

                <button class="btn text-white" style="background-color: #8B4513;">
                    Simpan
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>
        </div>
    </div>

</div>
@endsection
