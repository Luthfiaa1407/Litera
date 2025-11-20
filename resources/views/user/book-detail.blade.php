@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">{{ $book->title ?? 'Judul tidak tersedia' }}</h3>

        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    @if (!empty($book->cover))
                        <img src="{{ asset('storage/' . $book->cover) }}" class="img-fluid rounded-start" alt="Cover Buku">
                    @else
                        <div class="bg-secondary text-center text-white py-5">
                            Tidak ada cover
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p><strong>Penulis:</strong> {{ $book->author ?? '-' }}</p>
                        <p><strong>Penerbit:</strong> {{ $book->publisher ?? '-' }}</p>
                        <p><strong>Tahun:</strong> {{ $book->year ?? '-' }}</p>
                        <p><strong>Kategori:</strong> {{ $book->category->name ?? '-' }}</p>
                        <p><strong>Deskripsi:</strong> {{ $book->description ?? '-' }}</p>
                        <p><strong>Stok:</strong> {{ $book->stock ?? 0 }}</p>

                        <a href="{{ route('books.borrow', $book->id) }}" class="btn btn-primary mt-2 w-100">Pinjam</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
