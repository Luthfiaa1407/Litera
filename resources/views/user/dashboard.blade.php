@extends('layouts.app')

@section('content')
    <div class="min-h-screen" style="background-color: #FFFFFF;">
        <div class="max-w-7xl mx-auto px-6 py-12">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Greeting -->
            <div class="mb-16">
                <h1 class="text-5xl font-bold mb-2" style="color: #1F2937;">
                    Selamat Datang, {{ $user->name }}
                </h1>
                <p class="text-lg text-gray-500">
                    Kelola koleksi buku Anda dan temukan bacaan baru
                </p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                @php
                    $stats = [
                        ['icon' => 'fa-book', 'label' => 'PEMINJAMAN AKTIF', 'value' => $active_count],
                        ['icon' => 'fa-calendar', 'label' => 'SISA WAKTU', 'value' => $days_left ?? '-'],
                        ['icon' => 'fa-layer-group', 'label' => 'TOTAL BUKU', 'value' => $books_count],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="rounded-2xl p-8 border-2 bg-cyan-50 border-cyan-400 shadow-md">
                        <div class="mb-4">
                            <div class="inline-block p-3 rounded-lg bg-cyan-500 text-white">
                                <i class="fa-solid {{ $stat['icon'] }}"></i>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-600">{{ $stat['label'] }}</p>
                        <h3 class="text-4xl font-black text-indigo-900">{{ $stat['value'] }}</h3>
                    </div>
                @endforeach
            </div>

            <!-- Active Borrows -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold mb-6 text-indigo-900">Buku yang Sedang Dipinjam</h2>

                @if ($active_borrows->count())
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        @foreach ($active_borrows as $borrow)
                            <div class="border-2 border-cyan-400 bg-white rounded-2xl shadow-md overflow-hidden">
                                <div class="h-48 bg-gray-200">
                                    @if ($borrow->book && $borrow->book->cover)
                                        <img src="{{ asset('storage/' . $borrow->book->cover) }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="font-bold text-lg text-indigo-900">
                                        {{ $borrow->book->title ?? '-' }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-4">
                                        {{ $borrow->book->author ?? '-' }}
                                    </p>

                                    <div class="text-sm space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-gray-500">Dipinjam</span>
                                            <span class="font-semibold">
                                                {{ $borrow->borrow_date ? \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') : '-' }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-500">Jatuh Tempo</span>
                                            <span class="font-semibold">
                                                {{ $borrow->return_date ? \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') : '-' }}
                                            </span>
                                        </div>
                                        <div class="mt-4">
                                            <a href="{{ route('user.books.read', $borrow->book->id) }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="block w-full text-center py-3 rounded-lg text-white bg-gradient-to-r from-indigo-900 to-cyan-500">
                                                Baca Sekarang
                                            </a>
                                        </div>

                                    </div>



                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-cyan-50 border-2 border-dashed border-cyan-400 rounded-xl">
                        Tidak ada buku yang sedang dipinjam
                    </div>
                @endif
            </div>

            <!-- Available Books -->
            <div>
                <h2 class="text-3xl font-bold mb-6 text-indigo-900">Buku Tersedia</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @forelse($available_books as $book)
                        <div class="border-2 border-cyan-400 bg-white rounded-2xl shadow-md overflow-hidden">
                            <div class="h-48 bg-gray-200">
                                @if ($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="font-bold text-lg text-indigo-900">{{ $book->title }}</h3>
                                <p class="text-sm text-gray-500 mb-4">{{ $book->author }}</p>
                                <p class="text-sm font-medium text-gray-700 mb-4">
                                    Stok Tersedia: <span class="font-bold text-cyan-600">{{ $book->stock }}</span>
                                </p>
                                @if ($book->stock > 0)
                                    <a href="{{ route('user.books.show', $book) }}"
                                        class="block w-full text-center py-3 rounded-lg text-white bg-gradient-to-r from-indigo-900 to-cyan-500">
                                        Pinjam Sekarang
                                    </a>
                                @else
                                    <button disabled
                                        class="block w-full text-center py-3 rounded-lg text-gray-500 bg-gray-200 cursor-not-allowed">
                                        Stok Habis ({{ $book->stock }})
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-4 text-center py-12 bg-cyan-50 border-2 border-dashed border-cyan-400 rounded-xl">
                            Tidak ada buku tersedia
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection
