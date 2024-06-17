<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;

class BuyerController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'event_id'=> 'required',
            'seat_id'=> 'required',
        ]);

        $buyer = Buyer::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "phone"=> $request->phone,
            "event_id"=> $request->event_id,
            "seat_id"=> $request->seat_id,
        ]);
    }
}
