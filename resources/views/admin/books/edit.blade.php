@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <i class="fas fa-book text-[#06B6D4]"></i> Edit Buku
            </h3>

            <a href="{{ route('admin.books.index') }}"
                class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-100 transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 border border-slate-200">

            @if (session('success'))
                <div id="successAlert" class="mb-4 flex items-center p-4 text-white bg-green-500 rounded-lg shadow">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.books.form')

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin.books.index') }}"
                        class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-100 transition flex items-center gap-2">
                        <i class="fas fa-times"></i> Batal
                    </a>

                    <button type="submit"
                        class="px-5 py-3 bg-[#06B6D4] hover:bg-[#0891B2] text-white rounded-lg transition flex items-center gap-2">
                        <i class="fas fa-save"></i> Update Buku
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    const alert = document.getElementById('successAlert');
                    if (alert) {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 5000);
            });
        </script>
    @endif
@endsection
