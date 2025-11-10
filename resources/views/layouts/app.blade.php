<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraRead - Sistem Perpustakaan Digital</title>

    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --accent-color: #ffc107;
            --text-color: #333;
            --light-blue: #e9f2ff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            background-color: #f5f7fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header, footer {
            background: var(--light-blue);
            border-color: #b9d1f5;
        }

        header {
            border-bottom: 2px solid #b9d1f5;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        footer {
            border-top: 2px solid #b9d1f5;
            margin-top: auto;
        }

        .nav-link {
            font-weight: 600;
            color: var(--primary-color) !important;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem !important;
            border-radius: 5px;
        }

        .nav-link:hover {
            color: #1a3d7a !important;
            background-color: rgba(44, 90, 160, 0.1);
        }

        .brand {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
            text-decoration: none;
        }

        .brand i {
            margin-right: 8px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #1a3d7a;
            border-color: #1a3d7a;
        }

        main {
            flex: 1;
        }

        .welcome-section {
            background: linear-gradient(rgba(44, 90, 160, 0.8), rgba(44, 90, 160, 0.9));
            color: white;
            padding: 3rem 0;
            text-align: center;
            margin-bottom: 2rem;
        }

        .content-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container py-2">
                
                <a class="navbar-brand brand" href="#">
                    <i class="fas fa-book-reader"></i>LibraRead
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navMenu">

                    <ul class="navbar-nav gap-2">

                        <!-- Untuk Admin -->
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
                                <li class="nav-item"><a href="{{ route('admin.users.index') }}" class="nav-link"><i class="fas fa-users me-1"></i>Pengguna</a></li>
                                <li class="nav-item"><a href="{{ route('admin.books.index') }}" class="nav-link"><i class="fas fa-book me-1"></i>Koleksi Buku</a></li>
                                <li class="nav-item"><a href="{{ route('admin.categories.index') }}" class="nav-link"><i class="fas fa-tags me-1"></i>Kategori</a></li>
                                <li class="nav-item"><a href="{{ route('admin.borrows.index') }}" class="nav-link"><i class="fas fa-exchange-alt me-1"></i>Peminjaman</a></li>
                                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link"><i class="fas fa-sign-out-alt me-1"></i>Logout</a></li>

                            <!-- Untuk Member -->
                            @elseif(Auth::user()->role === 'member')
                                <li class="nav-item"><a href="{{ route('member.dashboard') }}" class="nav-link"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
                                <li class="nav-item"><a href="{{ route('books.index') }}" class="nav-link"><i class="fas fa-book me-1"></i>Katalog Buku</a></li>
                                <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link"><i class="fas fa-tags me-1"></i>Kategori</a></li>
                                <li class="nav-item"><a href="{{ route('borrows.index') }}" class="nav-link"><i class="fas fa-exchange-alt me-1"></i>Peminjaman Saya</a></li>
                                <li class="nav-item"><a href="{{ route('member.profile') }}" class="nav-link"><i class="fas fa-user me-1"></i>Profil</a></li>
                                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link"><i class="fas fa-sign-out-alt me-1"></i>Logout</a></li>
                            @endif
                        @endauth

                        <!-- Untuk Pengunjung (Guest) -->
                        @guest
                            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link"><i class="fas fa-home me-1"></i>Beranda</a></li>
                            <li class="nav-item"><a href="{{ route('books.index') }}" class="nav-link"><i class="fas fa-book me-1"></i>Katalog</a></li>
                            <li class="nav-item"><a href="{{ route('about') }}" class="nav-link"><i class="fas fa-info-circle me-1"></i>Tentang Kami</a></li>
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
                            <li class="nav-item"><a href="{{ route('register.form') }}" class="nav-link"><i class="fas fa-user-plus me-1"></i>Daftar</a></li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
        <div class="container">
            <!-- Section Selamat Datang -->
            <div class="welcome-section rounded">
                <h1 class="display-5 fw-bold">Selamat Datang di LibraRead</h1>
                <p class="lead">Sistem Perpustakaan Digital Modern</p>
                <p>Temukan, pinjam, dan nikmati ribuan koleksi buku kami</p>
            </div>

            <!-- Konten Utama -->
            <div class="content-card">
                <h2><i class="fas fa-book-open text-primary me-2"></i>Konten Utama</h2>
                <p class="lead">Ini adalah area konten utama website perpustakaan.</p>
                <p>Di sini akan ditampilkan berbagai informasi seperti:</p>
                <ul>
                    <li>Katalog buku terbaru</li>
                    <li>Buku populer</li>
                    <li>Pengumuman penting</li>
                    <li>Statistik peminjaman</li>
                </ul>
                <div class="mt-4">
                    <a href="#" class="btn btn-primary me-2"><i class="fas fa-search me-1"></i>Cari Buku</a>
                    <a href="#" class="btn btn-outline-primary"><i class="fas fa-list me-1"></i>Lihat Katalog</a>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <div class="text-primary">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                        <h4 class="mt-2">10,000+</h4>
                        <p class="text-muted">Judul Buku</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <div class="text-primary">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h4 class="mt-2">5,000+</h4>
                        <p class="text-muted">Anggota</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <div class="text-primary">
                            <i class="fas fa-exchange-alt fa-2x"></i>
                        </div>
                        <h4 class="mt-2">1,200+</h4>
                        <p class="text-muted">Peminjaman/Bulan</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <div class="text-primary">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                        <h4 class="mt-2">50+</h4>
                        <p class="text-muted">Kategori</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="row py-4">
                <div class="col-md-4">
                    <h5 class="brand mb-3">
                        <i class="fas fa-book-reader"></i>LibraRead
                    </h5>
                    <p>Sistem perpustakaan digital modern yang memudahkan Anda dalam meminjam dan mengelola buku.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-primary">Tentang Kami</a></li>
                        <li><a href="#" class="text-decoration-none text-primary">Katalog Buku</a></li>
                        <li><a href="#" class="text-decoration-none text-primary">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-decoration-none text-primary">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Kontak Kami</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Perpustakaan No. 123, Jakarta</p>
                    <p><i class="fas fa-phone me-2"></i> (021) 1234-5678</p>
                    <p><i class="fas fa-envelope me-2"></i> info@libraread.id</p>
                </div>
            </div>
            <div class="text-center py-3 border-top">
                <p class="m-0 fw-semibold text-primary">
                    <i class="far fa-copyright"></i> {{ date('Y') }} LibraRead — Sistem Perpustakaan Digital. All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>