@extends('layouts.app')

@section('content')
    <div class="min-h-screen" style="background-color: #FDFCF7;">
        <div class="max-w-7xl mx-auto px-6 py-12">

            <!-- Greeting Section -->
            <div class="mb-16">
                <h1 class="text-5xl font-bold mb-2" style="color: #333333;">
                    Selamat Datang, {{ $user->name }}
                </h1>
                <p class="text-lg" style="color: #999999;">
                    Kelola koleksi buku Anda dan temukan bacaan baru
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">

                <!-- Stat 1 -->
                <div class="group hover:shadow-lg transition-all duration-300 rounded-2xl p-8 border-2"
                    style="background-color: #FDFCF7; border-color: #D9D7CB;">
                    <div class="mb-6">
                        <div class="inline-block p-3 rounded-lg" style="background-color: #D9D7CB;">
                            <i class="fa-solid fa-book text-xl" style="color: #333333;"></i>
                        </div>
                    </div>
                    <p class="text-sm font-semibold mb-2" style="color: #999999;">PEMINJAMAN AKTIF</p>
                    <h3 class="text-4xl font-black mb-4" style="color: #333333;">
                        {{ $active_borrows->count() }}
                    </h3>
                    <p class="text-sm" style="color: #999999;">Buku sedang dipinjam</p>
                </div>

                <!-- Stat 2 -->
                <div class="group hover:shadow-lg transition-all duration-300 rounded-2xl p-8 border-2"
                    style="background-color: #FDFCF7; border-color: #D9D7CB;">
                    <div class="mb-6">
                        <div class="inline-block p-3 rounded-lg" style="background-color: #D9D7CB;">
                            <i class="fa-regular fa-calendar text-xl" style="color: #333333;"></i>
                        </div>
                    </div>
                    <p class="text-sm font-semibold mb-2" style="color: #999999;">SISA WAKTU</p>
                    <h3 class="text-4xl font-black mb-4" style="color: #333333;">
                        {{ $days_left !== null ? $days_left : '-' }}
                    </h3>
                    <p class="text-sm" style="color: #999999;">Hari peminjaman tersisa</p>
                </div>

                <!-- Stat 3 -->
                <div class="group hover:shadow-lg transition-all duration-300 rounded-2xl p-8 border-2"
                    style="background-color: #FDFCF7; border-color: #D9D7CB;">
                    <div class="mb-6">
                        <div class="inline-block p-3 rounded-lg" style="background-color: #D9D7CB;">
                            <i class="fa-solid fa-layer-group text-xl" style="color: #333333;"></i>
                        </div>
                    </div>
                    <p class="text-sm font-semibold mb-2" style="color: #999999;">TOTAL BUKU</p>
                    <h3 class="text-4xl font-black mb-4" style="color: #333333;">
                        {{ $books_count }}
                    </h3>
                    <p class="text-sm" style="color: #999999;">Tersedia di perpustakaan</p>
                </div>

            </div>

            <!-- Active Borrow Section -->
            <div class="mb-16">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold" style="color: #333333;">Buku yang Sedang Dipinjam</h2>
                    <div class="h-1 w-16 mt-3 rounded-full" style="background-color: #C8C5BC;"></div>
                </div>

                @forelse($active_borrows as $borrow)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="group hover:shadow-xl transition-all duration-300 rounded-2xl overflow-hidden border border-gray-100"
                            style="background-color: #FDFCF7;">
                            <div class="relative overflow-hidden h-48 bg-gray-200">
                                <img src="{{ asset('storage/' . $borrow->book->cover) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-bold mb-2 line-clamp-2" style="color: #333333;">
                                    {{ $borrow->book->title }}
                                </h3>
                                <p class="text-sm mb-4" style="color: #999999;">
                                    {{ $borrow->book->author }}
                                </p>

                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between text-sm">
                                        <span style="color: #999999;">Dipinjam</span>
                                        <span class="font-semibold" style="color: #333333;">
                                            {{ $borrow->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between text-sm">
                                        <span style="color: #999999;">Jatuh Tempo</span>
                                        <span class="font-semibold" style="color: #333333;">
                                            {{ $borrow->due_date->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <button class="w-full py-2 rounded-lg font-semibold transition-all duration-300"
                                    style="background-color: #C8C5BC; color: #333333;">
                                    <i class="fa-solid fa-undo mr-2"></i> Kembalikan
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 rounded-2xl border-2 border-dashed"
                        style="background-color: #FDFCF7; border-color: #D9D7CB;">
                        <i class="fa-solid fa-book-open text-4xl mb-4" style="color: #999999;"></i>
                        <p class="text-lg" style="color: #999999;">Tidak ada buku yang sedang dipinjam</p>
                    </div>
                @endforelse
            </div>

            <!-- Available Books -->
            <div>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold" style="color: #333333;">Buku Tersedia</h2>
                    <div class="h-1 w-16 mt-3 rounded-full" style="background-color: #C8C5BC;"></div>
                </div>

                @forelse($available_books as $book)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="group hover:shadow-xl transition-all duration-300 rounded-2xl overflow-hidden border border-gray-100"
                            style="background-color: #FDFCF7;">
                            <div class="relative overflow-hidden h-48 bg-gray-200">
                                <img src="{{ asset('storage/' . $book->cover) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-bold mb-2 line-clamp-2" style="color: #333333;">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-sm mb-6" style="color: #999999;">
                                    {{ $book->author }}
                                </p>

                                <a href="{{ route('books.show', $book->id) }}"
                                    class="w-full block text-center py-3 rounded-lg font-semibold transition-all duration-300 hover:opacity-90"
                                    style="background-color: #C8C5BC; color: #333333;">
                                    <i class="fa-solid fa-book-reader mr-2"></i> Pinjam Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 rounded-2xl border-2 border-dashed"
                        style="background-color: #FDFCF7; border-color: #D9D7CB;">
                        <i class="fa-solid fa-circle-xmark text-4xl mb-4" style="color: #999999;"></i>
                        <p class="text-lg" style="color: #999999;">Tidak ada buku tersedia</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection
