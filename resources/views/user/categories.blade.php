@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="min-h-screen" style="background-color: #FDFCF7;">

    <div class="border-b" style="border-color: #D9D7CB; background-color: #FDFCF7;">
        <div class="max-w-6xl mx-auto px-6 py-8 lg:px-8">
            <a href="{{ route('user.dashboard') }}" class="inline-block text-sm font-semibold" style="color: #C8C5BC;">
                ← Kembali
            </a>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-12 lg:px-8">
        <h1 class="text-3xl font-black mb-6" style="color: #1a1a1a;">Kategori</h1>

        <div class="row g-4">
            @foreach($categories as $cat)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('user.books', ['category' => $cat->id]) }}" class="card h-100 border-0 shadow-sm text-decoration-none">
                        <div style="height:140px; background:#D9D7CB; display:flex; align-items:center; justify-content:center;">
                            <div class="text-muted">Kategori</div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color:#1a1a1a;">{{ $cat->name }}</h5>
                            <p class="small text-muted">{{ $cat->books_count ?? $cat->books()->count() }} buku</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>

</div>
@endsection
