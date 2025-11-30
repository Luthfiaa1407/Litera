<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    <!-- Judul -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">
            <i class="fas fa-book mr-1 text-[#06B6D4]"></i> Judul
        </label>
        <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}"
            class="w-full p-3 rounded-lg border border-slate-300 focus:border-[#06B6D4] focus:ring-[#06B6D4] focus:ring-1 outline-none">
        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Penulis -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">
            <i class="fas fa-user-pen mr-1 text-[#06B6D4]"></i> Penulis
        </label>
        <input type="text" name="author" value="{{ old('author', $book->author ?? '') }}"
            class="w-full p-3 rounded-lg border border-slate-300 focus:border-[#06B6D4] focus:ring-[#06B6D4] focus:ring-1 outline-none">
    </div>

    <!-- Penerbit -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">
            <i class="fas fa-building mr-1 text-[#06B6D4]"></i> Penerbit
        </label>
        <input type="text" name="publisher" value="{{ old('publisher', $book->publisher ?? '') }}"
            class="w-full p-3 rounded-lg border border-slate-300 focus:border-[#06B6D4] focus:ring-[#06B6D4] focus:ring-1">
    </div>

    <!-- Tahun -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">
            <i class="fas fa-calendar mr-1 text-[#06B6D4]"></i> Tahun Terbit
        </label>
        <input type="number" name="year" value="{{ old('year', $book->year ?? '') }}"
            class="w-full p-3 rounded-lg border border-slate-300 focus:border-[#06B6D4] focus:ring-[#06B6D4] focus:ring-1">
    </div>

    <!-- Kategori -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">
            <i class="fas fa-tags mr-1 text-[#06B6D4]"></i> Kategori
        </label>
        <select name="category_id"
            class="w-full p-3 rounded-lg bg-white border border-slate-300 focus:border-[#06B6D4] focus:ring-[#06B6D4] focus:ring-1">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Cover -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">
            <i class="fas fa-image mr-1 text-[#06B6D4]"></i> Cover (jpg/png)
        </label>
        <input type="file" name="cover"
            class="w-full p-3 rounded-lg bg-white border border-slate-300 focus:border-[#06B6D4] focus:ring-[#06B6D4] focus:ring-1">

        @if (!empty($book->cover))
            <img src="{{ asset('storage/' . $book->cover) }}" class="mt-3 w-24 h-32 object-cover rounded shadow">
        @endif
    </div>

    <!-- PDF -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">
            <i class="fas fa-file-pdf mr-1 text-[#06B6D4]"></i> File Buku (PDF)
        </label>
        <input type="file" name="file_path"
            class="w-full p-3 rounded-lg bg-white border border-slate-300 focus:border-[#06B6D4] focus:ring-[#06B6D4] focus:ring-1">

        @if (!empty($book->file_path))
            <a href="{{ asset('storage/' . $book->file_path) }}" class="text-[#0891B2] mt-2 block hover:underline">
                <i class="fas fa-download"></i> Download File
            </a>
        @endif
    </div>

    <!-- Deskripsi -->
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-700 mb-1">
            <i class="fas fa-align-left mr-1 text-[#06B6D4]"></i> Deskripsi
        </label>
        <textarea name="description" rows="5"
            class="w-full p-3 rounded-lg border border-slate-300 focus:border-[#06B6D4] focus:ring-[#06B6D4] focus:ring-1">{{ old('description', $book->description ?? '') }}</textarea>
    </div>

</div>
