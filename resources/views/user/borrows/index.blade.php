@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">

    <h2 class="text-3xl font-bold mb-6" style="color: var(--color-primary-dark);">
        📚 Riwayat Peminjaman
    </h2>

    @if($borrows->isEmpty())
        <div class="bg-cyan-50 p-6 rounded-xl text-center text-gray-600 shadow">
            Anda belum melakukan peminjaman buku.
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($borrows as $borrow)
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:scale-[1.02] transition">
                    <h3 class="text-lg font-semibold mb-2">
                        {{ $borrow->book->title }}
                    </h3>

                    <p class="text-sm text-gray-500 mb-2">
                        Peminjam: {{ $borrow->user->name }}
                    </p>

                    <div class="text-sm space-y-1">
                        <p><strong>Tanggal Pinjam:</strong> {{ $borrow->borrow_date }}</p>
                        <p><strong>Tanggal Kembali:</strong> {{ $borrow->return_date }}</p>
                    </div>

                    @if($borrow->status == 'pending')
                        <span class="inline-block mt-4 px-4 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">
                            🕒 Menunggu Persetujuan
                        </span>
                    @elseif($borrow->status == 'approved')
                        <span class="inline-block mt-4 px-4 py-1 rounded-full text-sm bg-green-100 text-green-700">
                            ✅ Disetujui
                        </span>
                    @else
                        <span class="inline-block mt-4 px-4 py-1 rounded-full text-sm bg-red-100 text-red-700">
                            ❌ Ditolak
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
