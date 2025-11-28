@extends('layouts.user')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">Ajukan Peminjaman Buku</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('user.borrows.store') }}" method="POST">
                @csrf

                <!-- Pilih buku -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Buku</label>
                    <select name="book_id" class="form-select" required>
                        <option value="" disabled selected>-- Pilih Buku --</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">
                                {{ $book->title }} (stok: {{ $book->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal pinjam -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Pinjam</label>
                    <input type="date" name="borrow_date" class="form-control" required>
                </div>

                <!-- Tanggal kembali -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Kembali</label>
                    <input type="date" name="return_date" class="form-control" required>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('user.borrows.index') }}" class="btn btn-secondary me-2">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Ajukan Peminjaman
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
