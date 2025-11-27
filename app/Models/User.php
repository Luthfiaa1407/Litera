<?php

// File: app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone', 'is_verified',
        'otp',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke borrowings
    public function borrowings()
    {
        return $this->hasMany(Borrow::class);
    }

    // Helper method cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPengguna()
    {
        return $this->role === 'pengguna';
    }
}
