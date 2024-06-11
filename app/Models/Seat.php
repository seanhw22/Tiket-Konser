<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public static $event;
    use HasFactory;

    protected $fillable = [
        'event_id',
        'buyer_id',
        'seat_class',
        'seat_position_row',
        'seat_position_column',
        'available',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    public static function rules(Event $event)
{
    return [
        'seat_position_row' => 'nullable|integer|max:' . $event->total_seat_rows,
        'seat_position_column' => 'nullable|integer|max:' . $event->total_seat_columns,
    ];
}
}
