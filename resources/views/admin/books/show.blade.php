@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <a href="{{ route('user.books') }}" class="btn btn-secondary mb-3">
        ← Kembali
    </a>

    <div class="row">
        <div class="col-md-4">
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" 
                     class="img-fluid rounded shadow">
            @else
                <div class="bg-secondary text-white text-center py-5 rounded">
                    Tidak ada cover
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <h5 class="text-muted">{{ $book->author }}</h5>

            <p class="mt-3">
                <strong>Kategori:</strong> {{ $book->category->name }} <br>
                <strong>Penerbit:</strong> {{ $book->publisher ?? '-' }} <br>
                <strong>Tahun:</strong> {{ $book->year ?? '-' }} <br>
                <strong>Stok:</strong> {{ $book->stock }}
            </p>

            <p class="mt-3">{{ $book->description }}</p>

            @if($book->stock > 0)
                <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-lg mt-3 w-100">
                        Pinjam Buku
                    </button>
                </form>
            @else
                <div class="alert alert-danger mt-3">
                    Stok buku habis!
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
