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

    .nav-link, .navbar-brand, .dropdown-toggle {
        color: #fff !important;
        font-weight: 500;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        height: 110px;
    }

    .book-card {
        border-radius: 14px;
        overflow: hidden;
        border: none;
        box-shadow: 0px 5px 12px rgba(0,0,0,0.12);
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

    footer {
        background: #8b5e34;
        color: white;
        padding: 20px 0;
        margin-top: 60px;
        text-align: center;
    }

</style>


<div class="container mt-5">

    <!-- Greeting -->
    <h2 class="fw-bold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h2>

    <!-- Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <h6>Peminjaman Aktif</h6>
                <h3 class="fw-bold">3 Buku</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <h6>Peminjaman Tersisa</h6>
                <h3 class="fw-bold">5 Hari</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <h6>Total Buku</h6>
                <h3 class="fw-bold">47 Buku</h3>
            </div>
        </div>
    </div>

    <!-- Buku Dipinjam -->
    <h4 class="fw-bold mb-3">Buku yang Sedang Dipinjam</h4>

    <div class="row g-4 mb-5">
        @for($i=0; $i<3; $i++)
        <div class="col-md-4">
            <div class="book-card card">
                <img src="https://picsum.photos/200/300?random={{ $i }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="fw-bold">Judul Buku</h5>
                    <p class="text-muted">Penulis Buku</p>
                    <p><strong>Dipinjam:</strong> 12 Jan 2025</p>
                    <p><strong>Jatuh Tempo:</strong> 19 Jan 2025</p>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <!-- Buku Tersedia -->
    <h4 class="fw-bold mb-3">Buku Tersedia <span class="text-muted float-end">Lihat Semua</span></h4>

    <div class="row g-4 mb-5">
        @for($i=0; $i<6; $i++)
        <div class="col-md-4 col-lg-3">
            <div class="book-card card">
                <img src="https://picsum.photos/200/300?random={{ $i+10 }}" class="card-img-top">
                <div class="card-body">
                    <h6 class="fw-bold">Judul Buku</h6>
                    <p class="text-muted">Penulis</p>
                    <button class="btn w-100" style="background:#8b5e34;color:white;">Pinjam</button>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <!-- Kategori Populer -->
    <h4 class="fw-bold mb-3">Kategori Populer</h4>

    <div class="d-flex gap-2 mb-4">
        <span class="category-badge">Fiksi</span>
        <span class="category-badge">Novel</span>
        <span class="category-badge">Pengembangan Diri</span>
        <span class="category-badge">Sains</span>
        <span class="category-badge">Keuangan</span>
        <span class="category-badge">Sejarah</span>
    </div>

    <div class="row g-4">
        @for($i=0; $i<6; $i++)
        <div class="col-md-4 col-lg-3">
            <div class="book-card card">
                <img src="https://picsum.photos/200/300?random={{ $i+20 }}" class="card-img-top">
                <div class="card-body">
                    <h6 class="fw-bold">Judul Buku</h6>
                    <p class="text-muted">Kategori Populer</p>
                    <button class="btn w-100" style="background:#8b5e34;color:white;">Pinjam</button>
                </div>
            </div>
        </div>
        @endfor
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
