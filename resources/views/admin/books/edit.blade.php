@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Buku</h3>

    <form action="{{ route('admin.books.update', $book->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.books.form')

        <button class="btn btn-success mt-3">Update</button>
    </form>
</div>
@endsection
