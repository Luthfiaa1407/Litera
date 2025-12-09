<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * DETAIL BUKU UNTUK USER
     */
    public function show(Book $book) // singular
    {
        return view('user.book-detail', compact('book'));
    }

    /**
     * PROSES PINJAM BUKU
     */
    public function borrow(Book $book)
    {
        // Cek stok
        if ($book->stock <= 0) {
            return back()->with('error', 'Maaf, stok buku habis.');
        }

        // Cek apakah user sedang meminjam buku yang sama
        $activeStatuses = ['pending', 'approved', 'active'];
        $cek = Borrow::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', $activeStatuses)
            ->first();

        if ($cek) {
            return redirect()->route('user.books.show', $book)->with('error', 'Anda masih memiliki peminjaman/permintaan aktif untuk buku ini (Status: '.ucfirst($cek->status).').');
        }

        // Simpan ke tabel borrowings
        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'return_date' => now()->addDays(7),
            'status' => 'pending', // ✅ PERBAIKAN: Gunakan 'pending' untuk pinjaman baru
        ]);
        // Kurangi stok buku
        $book->decrement('stock');

        return redirect()->route('user.dashboard')
            ->with('success', 'Permintaan pinjam buku berhasil diajukan! Menunggu persetujuan Admin.');
    }

    /**
     * HALAMAN LIST BUKU UNTUK USER
     */
    public function userBooks(Request $request)
    {
        $query = Book::with('category')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $books = $query->paginate(40)->appends($request->query());

        $categories = Category::all();

        return view('user.books', compact('books', 'categories'));
    }

    /**
     * ADMIN – LIST BUKU
     */
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    /**
     * ADMIN – CREATE
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.books.create', compact('categories'));
    }

    /**
     * ADMIN – STORE
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048',
            'file_path' => 'mimes:pdf|max:10000',
        ]);

        $cover = null;
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $cover = $request->file('cover')->store('covers', 'public');
        }

        $file_path = null;
        if ($request->hasFile('file_path') && $request->file('file_path')->isValid()) {
            $file_path = $request->file('file_path')->store('books', 'public');
        }
        $year = null;
        if ($request->year) {
            // Jika formatnya YYYY-MM-DD → ambil YYYY saja
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $request->year)) {
                $year = substr($request->year, 0, 4);
            } else {
                $year = $request->year; // sudah berupa tahun biasa
            }
        }
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $year,
            'category_id' => $request->category_id,
            'cover' => $cover,
            'file_path' => $file_path,
            'description' => $request->description,
            'stock' => $request->stock ?? 0,
        ]);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * ADMIN – EDIT
     */
    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * ADMIN – UPDATE
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048',
            'file_path' => 'mimes:pdf|max:10000',
        ]);

        $data = $request->only([
            'title', 'author', 'publisher', 'year',
            'category_id', 'description', 'stock',
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        if ($request->hasFile('file_path')) {
            if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
                Storage::disk('public')->delete($book->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('books', 'public');
        }

        $book->update($data);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil diupdate!');
    }

    /**
     * ADMIN – DELETE
     */
    public function destroy(Book $book)
    {
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
            Storage::disk('public')->delete($book->file_path);
        }

        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    public function read(Book $book)
    {
        if (! $book->file_path || ! Storage::disk('public')->exists($book->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return response()->file(storage_path('app/public/'.$book->file_path));
    }
}
