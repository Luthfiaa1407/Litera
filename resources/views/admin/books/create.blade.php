@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">Tambah Buku</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li style="color:#700;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Pencarian Google Books --}}
        <div class="mb-3">
            <label for="searchBook" class="form-label">Cari Buku (judul / ISBN dari Google Books)</label>
            <input type="text" id="searchBook" class="form-control" placeholder="Ketik judul atau ISBN...">

            <div id="searchResult" class="border mt-1 bg-white" style="display:none; max-height:250px; overflow:auto;">
            </div>
        </div>

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Field buku utama --}}
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="authors" class="form-label">Penulis</label>
                {{-- name="author" disesuaikan dengan field di database & BookController --}}
                <input type="text" id="authors" name="author" class="form-control" value="{{ old('author') }}">
            </div>

            <div class="mb-3">
                <label for="publisher" class="form-label">Penerbit</label>
                <input type="text" id="publisher" name="publisher" class="form-control" value="{{ old('publisher') }}">
            </div>

            <div class="mb-3">
                <label for="published_date" class="form-label">Tahun Terbit</label>
                {{-- BookController pakai "year" --}}
                <input type="text" id="published_date" name="year" class="form-control" value="{{ old('year') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            {{-- Opsional: kategori dari Google Books (tidak wajib disimpan) --}}
            <div class="mb-3">
                <label for="categories" class="form-label">Kategori (Google Books)</label>
                <input type="text" id="categories" class="form-control" readonly>
            </div>

            {{-- Opsional: ISBN (kalau mau simpan, buat kolom di DB) --}}
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN (Google Books)</label>
                <input type="text" id="isbn" class="form-control" readonly>
            </div>

            {{-- Opsional: Thumbnail URL dari Google Books --}}
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail URL (Google Books)</label>
                <input type="text" id="thumbnail" class="form-control" readonly>
            </div>

            {{-- Field cover manual (file upload) --}}
            <div class="mb-3">
                <label for="cover" class="form-label">Upload Cover (opsional)</label>
                <input type="file" name="cover" id="cover" class="form-control">
            </div>

            {{-- Field file buku (pdf) --}}
            <div class="mb-3">
                <label for="file_path" class="form-label">File Buku (PDF, opsional)</label>
                <input type="file" name="file_path" id="file_path" class="form-control">
            </div>

            {{-- Kategori lokal (dari tabel categories) --}}
            <div class="mb-3">
                <label class="form-label">Kategori (Lokal)</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', 1) }}" min="1">
            </div>

            <button class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>

    {{-- jQuery untuk autofill --}}
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
                                    '<div class="p-2 text-muted">Tidak ada hasil.</div>'
                                ).show();
                                return;
                            }

                            let html = '';
                            items.forEach(function(book) {
                                let info = book.volumeInfo || {};
                                let title = info.title || '(Tanpa Judul)';
                                let authors = info.authors ? info.authors.join(', ') :
                                    'Tanpa Penulis';

                                html += `
                                    <div class="p-2 border-bottom select-book"
                                         data-id="${book.id}"
                                         style="cursor:pointer;">
                                        <strong>${title}</strong><br>
                                        <small>${authors}</small>
                                    </div>
                                `;
                            });

                            $('#searchResult').html(html).show();
                        })
                        .fail(function(xhr) {
                            console.error(xhr.responseText);
                            $('#searchResult').html(
                                '<div class="p-2 text-danger">Gagal mengambil data dari Google Books.</div>'
                            ).show();
                        });

                }, 500); // debounce 0.5 detik
            });

            $(document).on('click', '.select-book', function() {
                let id = $(this).data('id');

                $.get("{{ url('admin/books/google/detail') }}/" + id)
                    .done(function(data) {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

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
                    .fail(function(xhr) {
                        console.error(xhr.responseText);
                        alert('Gagal mengambil detail buku.');
                    });
            });

        });
    </script>
@endsection
