<?php

namespace App\Http\Controllers;
use App\Models\SeatClass;

use Illuminate\Http\Request;

class SeatClassController extends Controller
{
    public function store(Request $request, $event_id){
        foreach ($request->seatclass as $seatClassData) {
        $class = SeatClass::create([
            "event_id" => $event_id,
            "seat_class" => $seatClassData['seat_class'],
            "price" => $seatClassData['price'],
        ]);
    }
    }
}
