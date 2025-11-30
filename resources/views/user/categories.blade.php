@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="min-h-screen" style="background-color: #FDFCF7;">

    <div class="border-b" style="border-color: #D9D7CB; background-color: #FDFCF7;">
        <div class="max-w-6xl mx-auto px-6 py-8 lg:px-8">
            <a href="{{ route('user.dashboard') }}" class="inline-block text-sm font-semibold text-gray-600 hover:text-gray-800">← Kembali</a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold" style="color:#0891B2;">Kategori</h2>
                <p class="text-sm text-gray-500 mt-1">Daftar kategori buku. Pilih kategori untuk melihat koleksi terkait.</p>
            </div>
            <div class="text-sm text-gray-600">Total kategori: <strong>{{ $categories->count() }}</strong></div>
        </div>

        <!-- Category Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($categories as $cat)
                <a href="{{ route('user.books', ['category' => $cat->id]) }}" class="no-underline">
                    <div class="bg-white rounded-xl shadow p-4 border-t-4 hover:shadow-lg transition flex items-center gap-4 h-full" style="border-color:#06B6D4;">
                        <div class="flex-shrink-0">
                            <i class="fas fa-book text-3xl" style="color:#0891B2;"></i>
                        </div>

                        <div class="flex-1">
                            <div class="text-sm font-semibold text-gray-500">{{ $cat->name }}</div>
                            <div class="text-2xl font-bold" style="color:#06B6D4;">{{ $cat->books_count ?? $cat->books()->count() }}</div>
                            <div class="text-xs text-gray-400">buku</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if(method_exists($categories, 'links'))
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        @endif

    </div>

</div>
@endsection
