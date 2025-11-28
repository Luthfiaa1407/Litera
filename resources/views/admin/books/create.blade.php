@extends('layouts.app')

@section('content')
    <div class="mt-8 max-w-4xl mx-auto px-4">

        <h1 class="text-3xl font-bold mb-6 text-[#0891B2] flex items-center gap-2">
            <i class="fas fa-plus-circle"></i> Tambah Buku
        </h1>

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow">
                <strong class="font-semibold">Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-700">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Search Google Books --}}
        <div class="mb-4">
            <label class="font-semibold text-gray-700">Cari Buku (judul / ISBN dari Google Books)</label>
            <input id="searchBook" type="text"
                class="mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#0891B2] focus:outline-none"
                placeholder="Ketik judul atau ISBN...">

            <div id="searchResult" class="border rounded-md mt-1 bg-white hidden shadow max-h-64 overflow-auto">
            </div>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Judul</label>
                    <input id="title" name="title" type="text"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#0891B2]"
                        value="{{ old('title') }}" required>
                </div>

                {{-- Penulis --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Penulis</label>
                    <input id="authors" name="author" type="text"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#0891B2]"
                        value="{{ old('author') }}">
                </div>

                {{-- Penerbit --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Penerbit</label>
                    <input id="publisher" name="publisher" type="text"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#0891B2]"
                        value="{{ old('publisher') }}">
                </div>

                {{-- Tahun terbit --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Tahun Terbit</label>
                    <input id="published_date" name="year" type="text"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#0891B2]"
                        value="{{ old('year') }}">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#0891B2]">{{ old('description') }}</textarea>
                </div>

                {{-- Kategori Google Books --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Kategori (Google Books)</label>
                    <input id="categories" type="text"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 bg-gray-100" readonly>
                </div>

                {{-- ISBN --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">ISBN</label>
                    <input id="isbn" type="text"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 bg-gray-100" readonly>
                </div>

                {{-- Thumbnail --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Thumbnail URL</label>
                    <input id="thumbnail" type="text"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 bg-gray-100" readonly>
                </div>

                {{-- Upload cover --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Upload Cover (opsional)</label>
                    <input id="cover" name="cover" type="file"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2">
                </div>

                {{-- Upload file PDF --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">File Buku (PDF)</label>
                    <input id="file_path" name="file_path" type="file"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2">
                </div>

                {{-- Kategori lokal --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Kategori (Lokal)</label>
                    <select name="category_id"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#0891B2]"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Stok --}}
                <div class="mb-4">
                    <label class="font-semibold text-gray-700">Stok</label>
                    <input name="stock" type="number" min="1"
                        class="mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#0891B2]"
                        value="{{ old('stock', 1) }}">
                </div>

                <button class="px-5 py-2.5 bg-[#0891B2] text-white rounded-md shadow hover:bg-[#06B6D4] transition">
                    Simpan
                </button>

            </form>
        </div>

    </div>

    {{-- jQuery (masih diperlukan untuk autofill) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(function() {

            let searchTimeout = null;

            $('#searchBook').on('keyup', function() {
                let query = $(this).val();

                if (query.length < 3) {
                    $('#searchResult').hide().html('');
                    return;
                }

                clearTimeout(searchTimeout);

                searchTimeout = setTimeout(function() {
                    $.get("{{ route('admin.books.google.search') }}", {
                            q: query
                        })
                        .done(function(data) {

                            let items = data.items || [];
                            if (items.length === 0) {
                                $('#searchResult').html(
                                        '<div class="p-2 text-gray-500">Tidak ada hasil.</div>')
                                    .show();
                                return;
                            }

                            let html = '';
                            items.forEach(function(book) {
                                let info = book.volumeInfo || {};
                                let title = info.title || '(Tanpa Judul)';
                                let authors = info.authors ? info.authors.join(', ') :
                                    'Tanpa Penulis';

                                html += `
                            <div class="p-2 border-b hover:bg-gray-100 cursor-pointer select-book" data-id="${book.id}">
                                <strong>${title}</strong><br>
                                <small class="text-gray-600">${authors}</small>
                            </div>`;
                            });

                            $('#searchResult').html(html).show();
                        })
                        .fail(function() {
                            $('#searchResult').html(
                                '<div class="p-2 text-red-600">Gagal mengambil data dari Google Books.</div>'
                                ).show();
                        });

                }, 500);
            });

            $(document).on('click', '.select-book', function() {
                let id = $(this).data('id');

                $.get("{{ url('admin/books/google/detail') }}/" + id)
                    .done(function(data) {

                        $('#title').val(data.title || '');
                        $('#authors').val(data.authors || '');
                        $('#description').val(data.description || '');
                        $('#publisher').val(data.publisher || '');
                        $('#published_date').val(data.published_date || '');
                        $('#categories').val(data.categories || '');
                        $('#isbn').val(data.isbn || '');
                        $('#thumbnail').val(data.thumbnail || '');

                        $('#searchResult').hide();
                        $('#searchBook').val(data.title || '');
                    })
            });

        });
    </script>
@endsection
