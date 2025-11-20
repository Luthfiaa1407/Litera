@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #8B4513;">Dashboard Admin</h2>
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>

    <!-- Quick Stats -->
    <div class="row">

        <!-- Belum Disetujui -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-hourglass-half fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Pending</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $pending_count ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Dipinjam -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-book-reader fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Dipinjam</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $borrowed_count ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Sudah Dikembalikan -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-check-circle fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Kembali</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $returned_count ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- User Terdaftar -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-users fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Users</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $users_count ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Buku -->
        <div class="col-md-2 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-book fa-2x" style="color: #8B4513;"></i>
                    </div>
                    <h3 class="card-title" style="color: #8B4513;">Total Buku</h3>
                    <p class="card-text" style="color: #8B4513;">{{ $books_count ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- ✅ KELOLA BUKU -->
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.books.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-book-open fa-2x" style="color: #8B4513;"></i>
                        </div>
                        <h3 class="card-title" style="color: #8B4513;">Kelola</h3>
                        <p class="card-text" style="color: #8B4513;">Buku</p>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <!-- Riwayat Peminjaman Terbaru -->
    <div class="mt-5">
        <h4 class="fw-bold" style="color: #8B4513;">Riwayat Peminjaman Terbaru</h4>
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">

                @if(isset($recent_borrows) && count($recent_borrows) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Status</th>
                                <th>Tanggal Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_borrows as $borrow)
                            <tr>
                                <td>{{ $borrow->user->name }}</td>
                                <td>{{ $borrow->book->title }}</td>
                                <td>{{ ucfirst($borrow->status) }}</td>
                                <td>{{ $borrow->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Belum ada peminjaman terbaru.</p>
                @endif

            </div>
        </div>
    </div>

</div>
@endsection
