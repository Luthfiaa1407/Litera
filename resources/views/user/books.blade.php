@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="min-h-screen" style="background-color: #FDFCF7;">
    <div class="border-b" style="border-color: #D9D7CB; background-color: #FDFCF7;">
        <div class="max-w-4xl mx-auto px-6 py-8 lg:px-8">
            <a href="{{ route('user.dashboard') }}" class="inline-block text-sm font-semibold" style="color: #C8C5BC;">
                ← Kembali
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Header + search -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold" style="color:#0891B2;">Katalog Buku</h2>
                <p class="text-sm text-gray-500 mt-1">Jelajahi koleksi buku. Gunakan pencarian atau filter kategori untuk mempersempit hasil.</p>
            </div>

            <form method="GET" action="{{ route('user.books') }}" class="flex items-center gap-2 w-full sm:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau penulis..." class="px-3 py-2 border rounded-md w-full sm:w-72" />

                <select name="category" class="px-3 py-2 border rounded-md">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>

                <button class="px-4 py-2 rounded-md text-white text-sm" style="background:#0891B2;">Cari</button>
            </form>
        </div>

        @if($books->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($books as $book)
                    <a href="{{ route('user.books.show', $book) }}" class="no-underline">
                        <div class="bg-white rounded-xl shadow p-4 border-t-4 hover:shadow-lg transition h-full" style="border-color:#06B6D4;">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 w-28 h-36 bg-[#D9D7CB] rounded overflow-hidden">
                                    @if($book->cover)
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm">Tidak ada cover</div>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-[#1a1a1a]">{{ Str::limit($book->title, 60) }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $book->author }}</p>
                                    <p class="text-xs text-gray-400 mt-2">{{ $book->category->name ?? '-' }}</p>

                                    <div class="mt-4">
                                        <span class="inline-block px-3 py-1 rounded-full text-white text-sm bg-[#0891B2]">Lihat Detail</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $books->links() }}
            </div>
        @else
            <div class="text-center text-gray-500 py-6">
                <i class="fas fa-search me-2"></i> Tidak ditemukan buku.
            </div>
        @endif

    </div>
</div>
@endsection
