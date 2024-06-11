<?php


namespace App\Http\Controllers;
use App\Models\Seat;

use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function store(Request $request){
        $request->validate([
            "event_id"=> "required",
            "buyer_id"=> "required",
            "seat_class_id"=> "required",
            "seat_position_row"=> "required",
            "seat_position_column"=> "required",
            "available"=> "required",
        ]);

        $seat = Seat::create([
            "event_id"=> $request->event_id,
            "buyer_id"=> $request->buyer_id,
            "seat_class_id"=> $request->seat_class_id,
            "seat_position_row"=> $request->seat_position_row,
            "seat_position_column"=> $request->seat_position_column,
            "available"=> $request->available,
        ]);
    }
}
