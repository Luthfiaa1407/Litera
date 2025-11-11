<?php

// File: app/Models/Borrowing.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Helper method
    public function isDipinjam()
    {
        return $this->status === 'dipinjam';
    }

    public function isDikembalikan()
    {
        return $this->status === 'dikembalikan';
    }
}