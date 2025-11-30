<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleBooksService
{
    public function search(string $query): array
    {
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q'         => $query,
            'key'       => env('GOOGLE_BOOKS_API_KEY'),
            'maxResults'=> 10,
        ]);

        return $response->json();
    }

    public function detail(string $id): array
    {
        $response = Http::get("https://www.googleapis.com/books/v1/volumes/{$id}", [
            'key' => env('GOOGLE_BOOKS_API_KEY'),
        ]);

        return $response->json();
    }
}
