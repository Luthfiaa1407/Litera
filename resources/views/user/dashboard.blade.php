@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4eee4;
        }

        .navbar {
            background-color: #8b5e34;
        }

        .nav-link,
        .navbar-brand {
            color: #fff !important;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            height: 110px;
        }

        .book-card {
            border-radius: 14px;
            overflow: hidden;
            border: none;
            box-shadow: 0px 5px 12px rgba(0, 0, 0, 0.12);
            background: white;
        }

        .book-card img {
            height: 180px;
            object-fit: cover;
        }

        .category-badge {
            background: #8b5e34;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
        }
    </style>

    <div class="container mt-5">

        <!-- Greeting -->
        <h2 class="fw-bold mb-4">Selamat Datang, {{ $user->name }}!</h2>

        <!-- Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <h6>Peminjaman Aktif</h6>
                    <h3 class="fw-bold">{{ $active_borrows->count() }} Buku</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <h6>Peminjaman Tersisa</h6>
                    <h3 class="fw-bold">
                        {{ $days_left !== null ? $days_left . ' Hari' : '-' }}
                    </h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <h6>Total Buku</h6>
                    <h3 class="fw-bold">{{ $books_count }} Buku</h3>
                </div>
            </div>
        </div>

        <!-- Buku Dipinjam -->
        <h4 class="fw-bold mb-3">Buku yang Sedang Dipinjam</h4>

        <div class="row g-4 mb-5">
            @forelse($active_borrows as $borrow)
                <div class="col-md-4">
                    <div class="book-card card">
                        <img src="{{ asset('storage/' . $borrow->book->cover) }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="fw-bold">{{ $borrow->book->title }}</h5>
                            <p class="text-muted">{{ $borrow->book->author }}</p>
                            <p><strong>Dipinjam:</strong> {{ $borrow->created_at->format('d M Y') }}</p>
                            <p><strong>Jatuh Tempo:</strong> {{ $borrow->due_date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada buku yang sedang dipinjam.</p>
            @endforelse
        </div>

        <!-- Buku Tersedia -->
        <h4 class="fw-bold mb-3">Buku Tersedia</h4>

        <div class="row g-4 mb-5">
            @forelse($available_books as $book)
                <div class="col-md-4 col-lg-3">
                    <div class="book-card card">
                        <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top">
                        <div class="card-body">
                            <h6 class="fw-bold">{{ $book->title }}</h6>
                            <p class="text-muted">{{ $book->author }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn w-100"
                                style="background:#8b5e34;color:white;">
                                Pinjam
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada buku tersedia.</p>
            @endforelse
        </div>

    </div>
@endsection
