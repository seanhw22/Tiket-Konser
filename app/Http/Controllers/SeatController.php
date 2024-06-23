<?php


namespace App\Http\Controllers;
use App\Models\Seat;

use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function store($event_id, $seat_class_id, $seat_position_row, $seat_position_column){
        $class = Seat::create([
            "event_id" => $event_id,
            "seat_class_id" => $seat_class_id,
            "seat_position_row" => $seat_position_row,
            "seat_position_column" => $seat_position_column,
        ]);
    }

    public function retrieve($event_id){
        $seats = Seat::where('event_id', $event_id)->get();
        $seatsArray = $seats->toArray();
        return $seatsArray;
    }

    public function retrieveOne($seat_id){
        $seat = Seat::find($seat_id);
        return $seat;
    }

    public function retrieveAll(){
        $seats = Seat::all()->toArray();
        return $seats;
    }

    public function updateAvailability($seat_id){
        $seat = Seat::find($seat_id);
        $seat->available = !$seat->available;
        $seat->save();
    }

    public function makeSeatAvailable($seat_id){
        $seat = Seat::find($seat_id);
        $seat->available = true;
        $seat->save();
    }

    public function destroyAllInEvent($event_id){
        Seat::where('event_id', $event_id)->delete();
    }
}
