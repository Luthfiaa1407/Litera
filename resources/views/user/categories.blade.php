@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="min-h-screen" style="background-color: #FDFCF7;">
    <div class="border-b" style="border-color: #D9D7CB; background-color: #FDFCF7;">
        <div class="max-w-4xl mx-auto px-6 py-8 lg:px-8">
            <a href="{{ route('user.dashboard') }}" class="inline-block text-sm font-semibold" style="color: #C8C5BC;">
                ← Kembali
            </a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-12 lg:px-8">
        <h1 class="text-3xl font-black mb-6" style="color: #1a1a1a;">Kategori</h1>

        <div class="row g-3">
            @foreach($categories as $cat)
                <div class="col-12 col-md-6">
                    <a href="{{ route('user.categories.show', $cat) }}" class="d-block p-3 border rounded text-decoration-none">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1 fw-bold" style="color:#1a1a1a;">{{ $cat->name }}</h5>
                                <div class="small text-muted">{{ $cat->books_count ?? $cat->books()->count() }} buku</div>
                            </div>
                            <div class="text-muted">→</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
