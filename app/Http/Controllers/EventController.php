<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\SeatClassController;
use App\Http\Controllers\SeatController;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::all();
        return view('eventlist.index', compact('event'));
    }
    public function create()
    {
        return view("eventlist.create");
    }
    public function store(Request $request){
        $request->validate([
            'event_name' => 'required',
            'event_desc' => 'required',
            'total_seat_rows' => 'required',
            'total_seat_columns' => 'required',
            'seatclass' => 'required|array',
            'seatclass.*.seat_class' => 'required',
            'seatclass.*.price' => 'required',
        ]);

        $event = Event::create([
            "event_name"=> $request->event_name,
            "event_desc"=> $request->event_desc,
            "total_seat_rows"=> $request->total_seat_rows,
            "total_seat_columns"=> $request->total_seat_columns,
        ]);
        
        $event_id = $event->id;

        $seatClassController = new SeatClassController();
        $seatClassController->store($request, $event_id);

        return redirect()->route('eventlist')
            ->with('success','Event created successfully');
    }
    public function edit($id){
        $event = Event::find($id);
        return view('eventlist.edit', compact('event'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'event_name => required',
            'event_desc => required',
            'total_seat_rows => required',
            'total_seat_columns => required',
        ]);

        $update = [
            'event_name'=> $request->event_name,
            'event_desc'=> $request->event_desc,
            'total_seat_rows'=> $request->total_seat_rows,
            'total_seat_columns'=> $request->total_seat_columns,
        ];

        Event::whereId($id)->update($update);
        return redirect()->route('eventlist')
            ->with('success','Event updated successfully');
    }

    public function destroy($id){
        $event = Event::find($id);
        $event->delete();
        return redirect()->route('eventlist')
            ->with('success','Event deleted successfully');
    }
}
