<?php

// File: app/Models/Book.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'category_id',
        'cover',
        'file_path',
        'description',
    ];

    // Relasi ke category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke borrowings
    public function borrowings()
    {
        return $this->hasMany(Borrow::class);
    }

    // Helper method cek apakah buku sedang dipinjam
    public function isAvailable()
    {
        return !$this->borrowings()->where('status', 'dipinjam')->exists();
    }
}