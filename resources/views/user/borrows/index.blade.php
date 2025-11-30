@extends('layouts.user')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Riwayat Peminjaman</h4>
        <a href="{{ route('user.borrows.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Ajukan Peminjaman
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @error('error')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrows as $borrow)
                        <tr>
                            <td>{{ $borrow->book->title }}</td>
                            <td>{{ $borrow->borrow_date }}</td>
                            <td>{{ $borrow->return_date }}</td>
                            <td>
                                <span class="badge 
                                    @if ($borrow->status == 'pending') bg-warning 
                                    @elseif ($borrow->status == 'approved') bg-info
                                    @elseif ($borrow->status == 'active') bg-primary
                                    @elseif ($borrow->status == 'returned') bg-success
                                    @elseif ($borrow->status == 'rejected') bg-danger
                                    @endif
                                ">
                                    {{ ucfirst($borrow->status) }}
                                </span>
                                @if($borrow->admin_notes)
                                    <div class="small text-muted">{{ $borrow->admin_notes }}</div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                Belum ada riwayat peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
