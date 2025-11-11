<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'borrowings';

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date', 
        'status'
    ];

    protected $dates = [
        'borrow_date',
        'return_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}