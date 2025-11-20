@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Tambah Buku</h3>
@if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        @include('admin.books.form')

        <button class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
