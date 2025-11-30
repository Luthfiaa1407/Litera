<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show list of categories to users
     */
    public function index()
    {
        $categories = Category::withCount('books')->get();

        return view('user.categories', compact('categories'));
    }

    /**
     * Show books for a given category (with optional search)
     */
    public function show(Category $category, Request $request)
    {
        $query = Book::with('category')->where('category_id', $category->id)->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $books = $query->paginate(40)->appends($request->query());

        // Pagination will use the current request path; no explicit setPath required.

        $categories = Category::all();

        return view('user.books', compact('books', 'categories'))
            ->with('currentCategory', $category);
    }
}
