@extends('layouts.app')

@section('content')
    <!-- Updated to white background with modern dramatic color scheme -->
    <div class="min-h-screen" style="background-color: #FFFFFF;">

        <!-- Header -->
        <div class="border-b" style="border-color: #0EA5E9; background-color: #F0F9FF;">
            <div class="max-w-4xl mx-auto px-6 py-8 lg:px-8">
                <a href="{{ route('user.dashboard') }}" class="inline-block text-sm font-semibold" style="color: #0EA5E9;">
                    ← Kembali ke Katalog
                </a>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-12 lg:px-8">

            <!-- Book Detail Card -->
            <div style="background-color: #FFFFFF; border: 2px solid #0EA5E9; box-shadow: 0 8px 24px rgba(14, 165, 233, 0.15);"
                class="rounded-xl p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                    <!-- Book Cover -->
                    <div class="md:col-span-1">
                        <div class="h-96 rounded-lg overflow-hidden mb-6 shadow-md"
                            style="background: linear-gradient(135deg, #0EA5E9, #06B7D4);">
                            @if (!empty($book->cover))
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-sm text-white">
                                    Tidak ada cover
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="md:col-span-2">

                        <h1 class="text-4xl font-black mb-4" style="color: #1E1B4B;">
                            {{ $book->title ?? 'Judul tidak tersedia' }}
                        </h1>

                        <p class="text-lg mb-8" style="color: #475569;">
                            {{ $book->author ?? '-' }}
                        </p>

                        <!-- Details List -->
                        <div class="space-y-6 mb-8 pb-8" style="border-bottom: 2px solid #0EA5E9;">

                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #0EA5E9; letter-spacing: 0.5px;">PENULIS
                                </p>
                                <p style="color: #1E1B4B;">{{ $book->author ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #0EA5E9; letter-spacing: 0.5px;">
                                    PENERBIT</p>
                                <p style="color: #1E1B4B;">{{ $book->publisher ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #0EA5E9; letter-spacing: 0.5px;">TAHUN
                                    TERBIT</p>
                                <p style="color: #1E1B4B;">{{ $book->year ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #0EA5E9; letter-spacing: 0.5px;">
                                    KATEGORI</p>
                                <p style="color: #1E1B4B;">{{ $book->category->name ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold mb-2" style="color: #0EA5E9; letter-spacing: 0.5px;">STOK
                                    TERSEDIA</p>
                                <p class="text-2xl font-black" style="color: #1E1B4B;">
                                    {{ $book->stock ?? 0 }}
                                </p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-lg font-black mb-4" style="color: #1E1B4B;">Deskripsi</h3>
                            <p style="color: #475569; line-height: 1.8;">
                                {{ $book->description ?? 'Tidak ada deskripsi tersedia.' }}
                            </p>
                        </div>

                        <!-- Borrow Button -->
                        <!-- Updated button gradient to consistent indigo-to-cyan for all buttons -->
                        <a href="{{ route('user.borrow', $book->id) }}"
                            class="block w-full py-4 px-6 font-bold text-center rounded-lg transition-all shadow-md hover:shadow-lg hover:opacity-90 text-white"
                            style="background: linear-gradient(135deg, #1E1B4B, #0EA5E9); box-shadow: 0 10px 25px rgba(14, 165, 233, 0.2);">
                            Pinjam Buku
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
