@extends('layouts.app')

@section('content')
    <div class="min-h-screen" style="background-color: #FFFFFF;">
        <div class="max-w-7xl mx-auto px-6 py-12">

            <!-- Greeting Section -->
            <div class="mb-16">
                <h1 class="text-5xl font-bold mb-2" style="color: #1F2937;">
                    Selamat Datang, {{ $user->name }}
                </h1>
                <p class="text-lg" style="color: #6B7280;">
                    Kelola koleksi buku Anda dan temukan bacaan baru
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">

                @php
                    $stats = [
                        [
                            'icon' => 'fa-book',
                            'label' => 'PEMINJAMAN AKTIF',
                            'value' => $active_borrows->count(),
                        ],
                        [
                            'icon' => 'fa-calendar',
                            'label' => 'SISA WAKTU',
                            'value' => $days_left !== null ? $days_left : '-',
                        ],
                        [
                            'icon' => 'fa-layer-group',
                            'label' => 'TOTAL BUKU',
                            'value' => $books_count,
                        ],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="group hover:shadow-2xl transition-all duration-300 rounded-2xl p-8 border-2"
                        style="background-color: #F0F9FF; border-color: #06B6D4; box-shadow: 0 4px 16px rgba(6, 182, 212, 0.12);">

                        <div class="mb-6">
                            <div class="inline-block p-3 rounded-lg"
                                style="background: linear-gradient(135deg, #0891B2, #06B6D4); color: #FFFFFF;">
                                <i class="fa-solid {{ $stat['icon'] }} text-xl"></i>
                            </div>
                        </div>

                        <p class="text-sm font-semibold mb-2" style="color: #475569;">{{ $stat['label'] }}</p>
                        <h3 class="text-4xl font-black mb-4" style="color: #1E1B4B;">
                            {{ $stat['value'] }}
                        </h3>
                        <p class="text-sm" style="color: #475569;">Informasi terbaru</p>
                    </div>
                @endforeach

            </div>

            <!-- Active Borrow Section -->
            <div class="mb-16">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold" style="color: #1E1B4B;">Buku yang Sedang Dipinjam</h2>
                    <div class="h-1 w-16 mt-3 rounded-full" style="background: linear-gradient(90deg, #06B6D4, #EC4899);">
                    </div>
                </div>

                @forelse($active_borrows as $borrow)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="group hover:shadow-2xl transition-all duration-300 rounded-2xl overflow-hidden border-2"
                            style="background-color: #FFFFFF; border-color: #06B6D4; box-shadow: 0 4px 16px rgba(6, 182, 212, 0.12);">

                            <div class="relative overflow-hidden h-48 bg-gray-200">
                                <img src="{{ asset('storage/' . $borrow->book->cover) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-bold mb-2 line-clamp-2" style="color: #1E1B4B;">
                                    {{ $borrow->book->title }}
                                </h3>
                                <p class="text-sm mb-4" style="color: #475569;">
                                    {{ $borrow->book->author }}
                                </p>

                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between text-sm">
                                        <span style="color: #475569;">Dipinjam</span>
                                        <span class="font-semibold" style="color: #1E1B4B;">
                                            {{ $borrow->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between text-sm">
                                        <span style="color: #475569;">Jatuh Tempo</span>
                                        <span class="font-semibold" style="color: #1E1B4B;">
                                            {{ $borrow->due_date->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Button updated -->
                                <button class="w-full py-2 rounded-lg font-semibold transition-all duration-300 text-white"
                                    style="background: linear-gradient(135deg, #1E1B4B, #06B6D4); box-shadow: 0 10px 25px rgba(6, 182, 212, 0.2);">
                                    <i class="fa-solid fa-undo mr-2"></i> Kembalikan
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 rounded-2xl border-2 border-dashed"
                        style="background-color: #F0F9FF; border-color: #06B6D4;">
                        <i class="fa-solid fa-book-open text-4xl mb-4" style="color: #06B6D4;"></i>
                        <p class="text-lg" style="color: #475569;">Tidak ada buku yang sedang dipinjam</p>
                    </div>
                @endforelse
            </div>

            <!-- Available Books -->
            <div>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold" style="color: #1E1B4B;">Buku Tersedia</h2>
                    <div class="h-1 w-16 mt-3 rounded-full" style="background: linear-gradient(90deg, #06B6D4, #EC4899);">
                    </div>
                </div>

                @forelse($available_books as $book)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="group hover:shadow-2xl transition-all duration-300 rounded-2xl overflow-hidden border-2"
                            style="background-color: #FFFFFF; border-color: #06B6D4; box-shadow: 0 4px 16px rgba(6, 182, 212, 0.12);">

                            <div class="relative overflow-hidden h-48 bg-gray-200">
                                <img src="{{ asset('storage/' . $book->cover) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-bold mb-2 line-clamp-2" style="color: #1E1B4B;">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-sm mb-6" style="color: #475569;">
                                    {{ $book->author }}
                                </p>

                                <!-- Button updated -->
                                <a href="{{ route('users.books.show', $book) }}"
                                    class="w-full block text-center py-3 rounded-lg font-semibold transition-all duration-300 hover:opacity-90 text-white"
                                    style="background: linear-gradient(135deg, #1E1B4B, #06B6D4); box-shadow: 0 10px 25px rgba(6, 182, 212, 0.2);">
                                    <i class="fa-solid fa-book-reader mr-2"></i> Pinjam Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 rounded-2xl border-2 border-dashed"
                        style="background-color: #F0F9FF; border-color: #06B6D4;">
                        <i class="fa-solid fa-circle-xmark text-4xl mb-4" style="color: #06B6D4;"></i>
                        <p class="text-lg" style="color: #475569;">Tidak ada buku tersedia</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection
