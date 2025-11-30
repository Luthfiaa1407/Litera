@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-brown">Kelola Kategori</h2>

        <a href="{{ route('admin.categories.create') }}" 
           class="btn btn-brown text-white px-4">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead class="table-header-brown">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr class="table-row">
                            <td>{{ $index + $categories->firstItem() }}</td>

                            <td class="fw-bold text-brown">
                                <i class="fas fa-tags me-2 text-brown"></i>
                                {{ $category->name }}
                            </td>

                            <td class="text-muted">{{ $category->description }}</td>

                            <td>
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                <i class="fas fa-info-circle me-1"></i> Belum ada kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $categories->links() }}
            </div>

        </div>
    </div>

</div>

{{-- Custom Style --}}
<style>
    .text-brown {
        color: #8B4513 !important;
    }

    .btn-brown {
        background-color: #8B4513;
        transition: 0.2s;
    }

    .btn-brown:hover {
        background-color: #6f3410;
        color: #fff;
    }

    .table-header-brown {
        background: #f5e8d8 !important;
        color: #8B4513;
        font-weight: 600;
    }

    .table-row td {
        vertical-align: middle;
    }

    .table-row:hover {
        background: #faf3eb !important;
        transition: 0.2s;
    }
</style>
@endsection
