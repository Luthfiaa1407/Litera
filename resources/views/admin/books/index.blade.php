@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Kelola Buku</h3>

    <a href="{{ route('admin.books.create') }}" class="btn btn-primary mb-3">+ Tambah Buku</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $i => $book)
            <tr>
                <td>{{ $i + $books->firstItem() }}</td>
                <td>
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" width="50">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category->name }}</td>
                <td>{{ $book->year }}</td>
                <td>
                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.books.destroy', $book->id) }}"
                          method="POST" style="display:inline-block;">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin hapus?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $books->links() }}
</div>
@endsection
