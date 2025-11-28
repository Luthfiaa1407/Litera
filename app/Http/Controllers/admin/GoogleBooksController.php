<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleBooksController extends Controller
{
    /**
     * Pencarian buku di Google Books
     */
    public function search(Request $request)
    {
        $query = $request->q;

        if (! $query) {
            return response()->json(['items' => []]);
        }

        // Parameter dasar
        $params = [
            'q' => $query,
            'maxResults' => 10,
        ];

        // OPTIONAL: kalau kamu punya API key
        if (env('GOOGLE_BOOKS_API_KEY')) {
            $params['key'] = env('GOOGLE_BOOKS_API_KEY');
        }

        try {
            $response = Http::get('https://www.googleapis.com/books/v1/volumes', $params);

            if (! $response->successful()) {
                return response()->json([
                    'items' => [],
                    'error' => 'Failed to fetch data from Google Books',
                ], $response->status());
            }

            $data = $response->json();

            return response()->json($data ?? ['items' => []]);

        } catch (\Exception $e) {
            return response()->json([
                'items' => [],
                'error' => 'Exception: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Detail satu buku dari Google Books
     */
    public function detail(string $id)
    {
        $params = [];

        if (env('GOOGLE_BOOKS_API_KEY')) {
            $params['key'] = env('GOOGLE_BOOKS_API_KEY');
        }

        try {
            $response = Http::get("https://www.googleapis.com/books/v1/volumes/{$id}", $params);

            if (! $response->successful()) {
                return response()->json([
                    'error' => 'Failed to fetch detail from Google Books',
                ], $response->status());
            }

            $book = $response->json();
            $info = $book['volumeInfo'] ?? [];

            // Ambil data dengan aman
            $title = $info['title'] ?? '';
            $authorsArr = $info['authors'] ?? [];
            $authors = is_array($authorsArr) ? implode(', ', $authorsArr) : $authorsArr;
            $description = $info['description'] ?? '';
            $publisher = $info['publisher'] ?? '';
            $published = $info['publishedDate'] ?? '';
            $categoriesArr = $info['categories'] ?? [];
            $categories = is_array($categoriesArr) ? implode(', ', $categoriesArr) : $categoriesArr;

            $isbn = '';
            if (! empty($info['industryIdentifiers']) && is_array($info['industryIdentifiers'])) {
                $isbn = $info['industryIdentifiers'][0]['identifier'] ?? '';
            }

            $thumbnail = $info['imageLinks']['thumbnail'] ?? '';

            return response()->json([
                'title' => $title,
                'authors' => $authors,
                'description' => $description,
                'publisher' => $publisher,
                'published_date' => $published,
                'categories' => $categories,
                'isbn' => $isbn,
                'thumbnail' => $thumbnail,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Exception: '.$e->getMessage(),
            ], 500);
        }
    }
}
