<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unique_id',
        'email',
        'otp',
        'type',
        'send_via',
        'resend',
        'status',
        'expires_at',
    ];

    protected $dates = ['expires_at'];
}
