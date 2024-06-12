<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'event_desc',
        'total_seat_rows',
        'total_seat_columns',
        'deployed',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $table = 'event';

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
