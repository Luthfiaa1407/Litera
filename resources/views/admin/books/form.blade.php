<div class="row">
    <div class="col-md-6">
        <label>Judul</label>
        <input type="text" name="title" class="form-control"
               value="{{ old('title', $book->title ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Penulis</label>
        <input type="text" name="author" class="form-control"
               value="{{ old('author', $book->author ?? '') }}">
    </div>

    <div class="col-md-6 mt-2">
        <label>Penerbit</label>
        <input type="text" name="publisher" class="form-control"
               value="{{ old('publisher', $book->publisher ?? '') }}">
    </div>

    <div class="col-md-6 mt-2">
        <label>Tahun</label>
        <input type="number" name="year" class="form-control"
               value="{{ old('year', $book->year ?? '') }}">
    </div>

    <div class="col-md-6 mt-2">
        <label>Kategori</label>
        <select name="category_id" class="form-control">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mt-2">
        <label>Cover (jpg/png)</label>
        <input type="file" name="cover" class="form-control">

        @if(!empty($book->cover))
            <img src="{{ asset('storage/' . $book->cover) }}" width="80" class="mt-2">
        @endif
    </div>

    <div class="col-md-6 mt-2">
        <label>File Buku (PDF)</label>
        <input type="file" name="file_path" class="form-control">

        @if(!empty($book->file_path))
            <p class="mt-2"><a href="{{ asset('storage/' . $book->file_path) }}">Download File</a></p>
        @endif
    </div>

    <div class="col-md-12 mt-2">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" rows="5">{{ old('description', $book->description ?? '') }}</textarea>
    </div>
</div>
