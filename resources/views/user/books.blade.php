@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="min-h-screen" style="background-color: #FDFCF7;">
    <div class="border-b" style="border-color: #D9D7CB; background-color: #FDFCF7;">
        <div class="max-w-4xl mx-auto px-6 py-8 lg:px-8">
            <a href="{{ route('user.dashboard') }}" class="inline-block text-sm font-semibold" style="color: #C8C5BC;">
                ← Kembali
            </a>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-12 lg:px-8">
        <h1 class="text-3xl font-black mb-6" style="color: #1a1a1a;">Katalog Buku</h1>

        <div class="mb-6">
            <form method="GET" action="{{ route('user.books') }}" class="row g-2">
                <div class="col-md-6 mb-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul atau penulis...">
                </div>

                <div class="col-md-4 mb-2">
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-2">
                    <button class="btn text-white w-100" style="background-color: #8B4513;">Cari</button>
                </div>
            </form>
        </div>

        @if($books->count())
            <div class="row g-4">
                @foreach($books as $book)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div style="height:220px; overflow:hidden; background-color:#D9D7CB;">
                                @if($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">Tidak ada cover</div>
                                @endif
                            </div>

                            <div class="card-body">
                                <h5 class="card-title fw-bold" style="color:#1a1a1a;">{{ Str::limit($book->title, 60) }}</h5>
                                <p class="mb-1 text-muted">{{ $book->author }}</p>
                                <p class="mb-2 small text-muted">{{ $book->category->name ?? '-' }}</p>

                                <a href="{{ route('user.books.show', $book) }}" class="btn btn-outline-secondary btn-sm">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $books->links() }}
            </div>
        @else
            <div class="text-center text-muted py-6">
                <i class="fas fa-search me-2"></i> Tidak ditemukan buku.
            </div>
        @endif

    </div>
</div>
@endsection
