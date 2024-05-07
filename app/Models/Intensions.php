<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intensions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'start_date',
        'last_complate_date',
        'end_date',
        'percent',
        'is_сontinues',
    ];
}
