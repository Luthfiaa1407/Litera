@extends('layouts.app')

@section('content')
    <div class="min-h-screen" style="background-color: #FDFCF7;">
        <!-- Header -->
        <div class="border-b" style="border-color: #D9D7CB; background-color: #FDFCF7;">
            <div class="max-w-4xl mx-auto px-6 py-8 lg:px-8">
                <a href="{{ route('user.dashboard') }}" class="inline-block text-sm font-semibold" style="color: #C8C5BC;">
                    ← Kembali ke Katalog
                </a>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-12 lg:px-8">
            <!-- Book Detail -->
            <div style="background-color: #FDFCF7; border: 2px solid #D9D7CB;" class="rounded-lg p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Book Cover -->
                    <div class="md:col-span-1">
                        <div class="h-96 rounded-lg overflow-hidden mb-6" style="background-color: #D9D7CB;">
                            @if (!empty($book->cover))
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-sm" style="color: #999;">
                                    Tidak ada cover
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Book Information -->
                    <div class="md:col-span-2">
                        <h1 class="text-4xl font-black mb-4" style="color: #1a1a1a;">
                            {{ $book->title ?? 'Judul tidak tersedia' }}</h1>

                        <p class="text-lg mb-8" style="color: #999;">{{ $book->author ?? '-' }}</p>

                        <!-- Details -->
                        <div class="space-y-6 mb-8 pb-8" style="border-bottom: 2px solid #D9D7CB;">
                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #C8C5BC;">PENULIS</p>
                                <p style="color: #1a1a1a;">{{ $book->author ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #C8C5BC;">PENERBIT</p>
                                <p style="color: #1a1a1a;">{{ $book->publisher ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #C8C5BC;">TAHUN TERBIT</p>
                                <p style="color: #1a1a1a;">{{ $book->year ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #C8C5BC;">KATEGORI</p>
                                <p style="color: #1a1a1a;">{{ $book->category->name ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #C8C5BC;">STOK TERSEDIA</p>
                                <p class="text-2xl font-black" style="color: #1a1a1a;">{{ $book->stock ?? 0 }}</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-lg font-black mb-4" style="color: #1a1a1a;">Deskripsi</h3>
                            <p style="color: #999; line-height: 1.8;">
                                {{ $book->description ?? 'Tidak ada deskripsi tersedia.' }}
                            </p>
                        </div>

                        <!-- Borrow Button -->
                        <a href="{{ route('user.borrow', $book->id) }}"
                            class="block w-full py-4 px-6 font-bold text-center rounded-lg transition-all"
                            style="background-color: #C8C5BC; color: #FDFCF7;">
                            Pinjam Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
