<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $table = 'borrowings';

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'status', // ['pending', 'approved', 'rejected', 'active', 'returned', 'auto_returned']
        'admin_notes',
        'request_date',
        'approved_date',
        'approved_by',
    ];

    protected $dates = [
        'borrow_date',
        'return_date',
        'request_date',
        'approved_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Scope untuk status berbeda
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['approved', 'active']);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Cek apakah sudah melewati tenggat waktu
    public function getIsOverdueAttribute()
    {
        return $this->status === 'active' && $this->return_date < now();
    }
}
