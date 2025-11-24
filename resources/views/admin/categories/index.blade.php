@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #8B4513;">Kelola Kategori</h2>

        <a href="{{ route('admin.categories.create') }}" 
           class="btn text-white" 
           style="background-color: #8B4513;">
            + Tambah Kategori
        </a>
    </div>

    <!-- Card List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead style="background-color: #f5e8d8;">
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + $categories->firstItem() }}</td>
                            <td class="fw-bold" style="color: #8B4513;">
                                <i class="fas fa-tags me-2" style="color: #8B4513;"></i>
                                {{ $category->name }}
                            </td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="btn btn-warning btn-sm">
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
                                Belum ada kategori.
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
@endsection
