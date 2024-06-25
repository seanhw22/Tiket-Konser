<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;

class BuyerController extends Controller
{
    public function index(){
        $eventController = new EventController();
        $seatClassController = new SeatClassController();
        $seatController = new SeatController();
        $buyers = Buyer::all();
        $events = $eventController->retrieveAll();
        $seatClasses = $seatClassController->retrieveAll();
        $seats = $seatController->retrieveAll();
        for ($i = 0; $i < count($seats); $i++) {
            $seats[$i]['seat_position_row'] = $this->numberToLetter($seats[$i]['seat_position_row']);
        }
        $search = '';
        return view('buyerlist.index', compact('buyers', 'events', 'seatClasses', 'seats', 'search'));
    }

    public function search(Request $request){
        $eventController = new EventController();
        $seatClassController = new SeatClassController();
        $seatController = new SeatController();
        $search = $request->search;
        $events = $eventController->retrieveAll();
        $seatClasses = $seatClassController->retrieveAll();
        $seats = $seatController->retrieveAll();
        if ($search === '') {
            return redirect()->route('buyerlist');
        }
        $buyers = Buyer::where('name', 'like', '%' . $search . '%')->get();
        if ($buyers->isEmpty()) {
            return redirect()->route('buyerlist')
                ->with('failure','Event does not exist.');
        }
        return view('buyerlist.index', compact('buyers', 'events', 'seatClasses', 'seats', 'search'));
    }

    public function sortAsc(Request $request)
    {
        $search = $request->search;
        $eventController = new EventController();
        $seatClassController = new SeatClassController();
        $seatController = new SeatController();
        $buyers = Buyer::all();
        $events = $eventController->retrieveAll();
        $seatClasses = $seatClassController->retrieveAll();
        $seats = $seatController->retrieveAll();
        for ($i = 0; $i < count($seats); $i++) {
            $seats[$i]['seat_position_row'] = $this->numberToLetter($seats[$i]['seat_position_row']);
        }
        $buyers = Buyer::where('name', 'like', '%' . $search . '%')
            ->orderBy('name', 'asc')->orderBy('email', 'asc')->get();
        return view('buyerlist.index', compact('buyers', 'events', 'seatClasses', 'seats', 'search'));
    }

    public function sortDesc(Request $request)
    {
        $search = $request->search;
        $eventController = new EventController();
        $seatClassController = new SeatClassController();
        $seatController = new SeatController();
        $buyers = Buyer::all();
        $events = $eventController->retrieveAll();
        $seatClasses = $seatClassController->retrieveAll();
        $seats = $seatController->retrieveAll();
        for ($i = 0; $i < count($seats); $i++) {
            $seats[$i]['seat_position_row'] = $this->numberToLetter($seats[$i]['seat_position_row']);
        }
        $buyers = Buyer::where('name', 'like', '%' . $search . '%')
            ->orderBy('name', 'desc')->orderBy('email', 'desc')->get();
        return view('buyerlist.index', compact('buyers', 'events', 'seatClasses', 'seats', 'search'));
    }
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

        $buyer_id = $buyer->id;

        return $buyer_id;
    }

    public function retrieve($seat_id){
        $buyer = Buyer::where("seat_id", $seat_id)->first();
        return $buyer;
    }

    public function edit($id){
        $buyer = Buyer::find($id);
        $seatController = new SeatController();
        $seatClassController = new SeatClassController();
        $eventController = new EventController();
        $event = $eventController->retrieveOne($buyer->event_id);
        $seat = $seatController->retrieveOne($buyer->seat_id);
        $seatClass = $seatClassController->retrieveOne($seat->seat_class_id);
        $seat = $seat->toArray();
        $seat['seat_position_row'] = $this->numberToLetter($seat['seat_position_row']);
        return view('buyerlist.edit', compact('buyer', 'event', 'seat', 'seatClass'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $buyer = Buyer::find($id);
        $buyer->update([
            "name"=> $request->name,
            "email"=> $request->email,
            "phone"=> $request->phone,
        ]);
        return redirect()->route('buyerlist')
            ->with('success',"Buyer updated successfully.");
    }

    public function destroy($id){
        $buyer = Buyer::find($id);
        $seatController = new SeatController();
        $seatController->makeSeatAvailable($buyer->seat_id);
        $seatController->removeBuyerId($buyer->seat_id);
        $buyer->delete();
        return redirect()->route('buyerlist')
            ->with('success',"Buyer deleted successfully.");
    }

    function numberToLetter($number) {
        if ($number < 1) {
            return "Invalid number";
        }
        $alphabet = range('A', 'Z');
        $letterCount = count($alphabet);
        
        $result = "";
        while ($number > 0) {
            $remainder = ($number - 1) % $letterCount;
            $result = $alphabet[$remainder] . $result;
            $number = floor(($number - 1) / $letterCount);
        }
        return $result;
    }
}
