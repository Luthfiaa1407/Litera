@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Pending Request Peminjaman</h3>

    @if($pendingBorrows->count() === 0)
        <div class="alert alert-info">Belum ada permintaan</div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingBorrows as $borrow)
                    <tr>
                        <td>{{ $borrow->user->name }}</td>
                        <td>{{ $borrow->book->title }}</td>
                        <td>{{ $borrow->borrow_date }}</td>
                        <td>{{ $borrow->return_date }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.borrows.approve', $borrow->id) }}" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-success btn-sm">Setujui</button>
                            </form>

                            <form method="POST" action="{{ route('admin.borrows.reject', $borrow->id) }}" style="display:inline-block;">
                                @csrf
                                <input type="hidden" name="admin_notes" value="Ditolak oleh admin">
                                <button class="btn btn-danger btn-sm">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
