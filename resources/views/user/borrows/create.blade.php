@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-2xl">

    <div class="bg-white rounded-2xl shadow-xl p-8">

        <h2 class="text-2xl font-bold mb-6 text-center" style="color: var(--color-primary-dark);">
            📖 Form Peminjaman Buku
        </h2>

        <div class="mb-6 p-4 bg-cyan-50 rounded-xl">
            <h3 class="font-semibold text-lg">{{ $book->title }}</h3>
            <p class="text-sm text-gray-500">oleh {{ $book->author }}</p>
        </div>

        <form action="{{ route('user.borrows.store', $book->id) }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block font-medium mb-1">Tanggal Pinjam</label>
                <input type="date" name="borrow_date"
                    class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-cyan-400 focus:outline-none" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Kembali</label>
                <input type="date" name="return_date"
                    class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-cyan-400 focus:outline-none" required>
            </div>

            <button type="submit"
                class="w-full py-3 rounded-xl text-white font-semibold text-lg transition hover:scale-[1.01]"
                style="background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));">
                Ajukan Peminjaman
            </button>

        </form>

    </div>

</div>
@endsection
