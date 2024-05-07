<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    const STATUS_NEW = 'new';
    const STATUS_VERIFIED = 'verified';

    protected $fillable = [
        'status',
        'expire_date',
        'email',
        'code',
    ];
}
