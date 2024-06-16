<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\SeatClassController;
use App\Http\Controllers\SeatController;
use App\Models\SeatClass;
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
            'total_seat_columns' => 'required',
            'end_date' => 'required',
            'seatclass' => 'required|array',
            'seatclass.*.seat_class' => 'required',
            'seatclass.*.price' => 'required',
            'seatclass.*.total_seat_rows' => 'required',
            'seatclass.*.color_code' => 'required',
        ]);

        $event = Event::create([
            "event_name"=> $request->event_name,
            "event_desc"=> $request->event_desc,
            "end_date"=> $request->end_date,
            "total_seat_columns"=> $request->total_seat_columns,
        ]);
        
        $event_id = $event->id;

        $seatClassController = new SeatClassController();
        $seatClassController->store($request, $event_id);
        EventController::createSeats($event_id);
        return redirect()->route('eventlist')
            ->with('success','Event created successfully');
    }
    public function edit($id){
        $event = Event::find($id);
        $seatClassController = new SeatClassController();
        $seatclass = $seatClassController->retrieve($id);
        $seatclassstring = json_encode($seatclass);
        if ($event->deployed == true){
            return redirect()->route('eventlist')
                ->with('failure','Event already deployed, cannot edit an event that has been deployed.');
        }

        return view('eventlist.edit', compact('event', 'seatclass', 'seatclassstring'));
    }

    
    public function showDetails($id){
        $event = Event::find($id);
        $seatClassController = new SeatClassController();
        $seatController = new SeatController();
        $seatClasses = $seatClassController->retrieve($id);
        $seatClassLength = count($seatClasses);
        $seats = $seatController->retrieve($id);
        $total_seat_rows = 0;
        foreach ($seatClasses as $seatClass) {
            $total_seat_rows += $seatClass['total_seat_rows'];
        }

        return view('eventlist.details', compact('event', 'seatClasses', 'seatClassLength', 'seats', 'total_seat_rows'));
        
    }
    public function update(Request $request, $id){
        $request->validate([
            'event_name' => 'required',
            'event_desc' => 'required',
            'total_seat_columns' => 'required',
            'end_date' => 'required',
            'seatclass' => 'required|array',
            'seatclass.*.id' => 'required',
            'seatclass.*.seat_class' => 'required',
            'seatclass.*.price' => 'required',
            'seatclass.*.total_seat_rows' => 'required',
            'seatclass.*.color_code' => 'required',
        ]);

        $update = [
            'event_name'=> $request->event_name,
            'event_desc'=> $request->event_desc,
            'total_seat_columns'=> $request->total_seat_columns,
            'end_date'=> $request->end_date
        ];

        Event::whereId($id)->update($update);

        $seatClassController = new SeatClassController();
        $seatClassController->update($request, $id);
        EventController::createSeats($id);
        return redirect()->route('eventlist')
            ->with('success','Event updated successfully');
    }

    public function destroy($id){
        $event = Event::find($id);
        $seatClassController = new SeatClassController();
        $seatClasses = $seatClassController->retrieve($id);
        foreach ($seatClasses as $seatClass) {
            $seatClassController->destroy($seatClass['id']);
        }
        $event->delete();
        return redirect()->route('eventlist')
            ->with('success','Event deleted successfully');
    }

    public function deploy($id){
        $event = Event::find($id);
        $event->deployed = true;
        $event->save();

        return redirect()->route('eventlist')
            ->with('success','Event deployed successfully');
    }

    public function createSeats($id){
        $seatClassController = new SeatClassController();
        $seatController = new SeatController();
        $seatController->destroyAll($id);
        $seatClasses = $seatClassController->retrieve($id);
        $event = Event::find($id)->toArray();
        $totalRows = 0;
        $i = 1;
        foreach ($seatClasses as $seatClass) {
            $totalRows = $totalRows + $seatClass['total_seat_rows'];
            for ($i ; $i <= $totalRows ; $i++) {
                for ($j=1 ; $j <= $event['total_seat_columns'] ; $j++) {
                    $seatController->store($id, $seatClass['id'], $i, $j);
                }
            }
        }
        return redirect()->route('eventlist')
            ->with('success','Seats created successfully');
    }
}
