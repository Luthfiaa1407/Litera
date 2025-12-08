@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="min-h-screen" style="background-color: #FDFCF7;">

    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- SEARCH + FILTER (DI ATAS) -->
        <div class="bg-white rounded-xl shadow-sm p-4 mb-8 border border-[#E5E3D8]">
            <h2 class="text-2xl font-bold mb-2" style="color:#0891B2;">Katalog Buku</h2>
            <p class="text-sm text-gray-500 mb-4">
                Cari buku berdasarkan judul, penulis, atau kategori.
            </p>

            <form method="GET" action="{{ route('user.books') }}" 
                  class="grid grid-cols-1 md:grid-cols-3 gap-3">

                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari judul atau penulis..."
                    class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-[#0891B2]" 
                />

                <select 
                    name="category" 
                    class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0891B2]">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <button 
                    type="submit"
                    class="px-4 py-2 rounded-lg text-white font-semibold hover:opacity-90 transition"
                    style="background: #0891B2;">
                    Cari Buku
                </button>

            </form>
        </div>

        <!-- GRID KATALOG BUKU (DI BAWAH) -->
        @if($books->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach($books as $book)
                    <a href="{{ route('user.books.show', $book) }}" class="block h-full">
                        <div class="bg-white rounded-xl shadow hover:shadow-lg transition border-t-4 h-full flex flex-col"
                             style="border-color:#06B6D4;">

                            <!-- COVER -->
                            <div class="h-44 bg-[#D9D7CB] rounded-t-xl overflow-hidden flex items-center justify-center">
                                @if($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" 
                                         alt="{{ $book->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <span class="text-sm text-gray-500">Tidak ada cover</span>
                                @endif
                            </div>

                            <!-- ISI -->
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="text-base font-semibold text-[#1a1a1a] leading-snug mb-1">
                                    {{ Str::limit($book->title, 50) }}
                                </h3>

                                <p class="text-sm text-gray-500">{{ $book->author }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $book->category->name ?? '-' }}
                                </p>

                                <div class="mt-auto pt-4">
                                    <span 
                                        class="inline-block w-full text-center px-3 py-2 rounded-lg text-white text-sm"
                                        style="background:#0891B2;">
                                        Lihat Detail
                                    </span>
                                </div>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>

            <!-- PAGINATION -->
            <div class="mt-6">
                {{ $books->links() }}
            </div>

        @else
            <div class="text-center text-gray-500 py-12">
                <i class="fas fa-search mb-3 text-xl"></i>
                <p>Tidak ditemukan buku.</p>
            </div>
        @endif

    </div>
</div>
@endsection
