<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'event_id',
        'seat_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $table = 'buyer';
}
