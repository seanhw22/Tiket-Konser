<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'seat_class',
        'price',
    ];

    protected $table = 'seatclass';
}
