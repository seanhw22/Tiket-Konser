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
        'total_seat_rows',
        'color_code',
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }

    protected $table = 'seatclass';
}
