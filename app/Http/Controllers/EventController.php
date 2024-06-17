<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\SeatClassController;
use App\Http\Controllers\SeatController;
use Illuminate\Http\Request;
use DateTime;

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
            'event_image' => 'required',
            'event_date' => 'required',
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
            "event_image"=> $request->event_image,
            "event_date"=> $request->event_date,
            "end_date"=> $request->end_date,
            "total_seat_columns"=> $request->total_seat_columns,
        ]);
        
        $event_id = $event->id;

        $seatClassController = new SeatClassController();
        $seatClassController->store($request, $event_id);
        return redirect()->route('eventlist')
            ->with('success',"Event created successfully, don't forget to create seats before deploying and after editing.");
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

    public function update(Request $request, $id){
        $request->validate([
            'event_name' => 'required',
            'event_desc' => 'required',
            'event_image' => 'required',
            'event_date' => 'required',
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
            'event_image'=> $request->event_image,
            'event_date'=> $request->event_date,
            'total_seat_columns'=> $request->total_seat_columns,
            'end_date'=> $request->end_date
        ];

        Event::whereId($id)->update($update);

        $seatClassController = new SeatClassController();
        $seatClassController->update($request, $id);
        EventController::createSeats($id);
        return redirect()->route('eventlist')
            ->with('success',"Event updated successfully, don't forget to create seats before deploying and after editing.");
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

    public function createSeats($id){
        $seatClassController = new SeatClassController();
        $seatController = new SeatController();
        $seatController->destroyAllInEvent($id);
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

    public function showDetails($id){
        $event = Event::find($id);
        $seatClassController = new SeatClassController();
        $seatController = new SeatController();
        $seatClasses = $seatClassController->retrieve($id);
        $seats = $seatController->retrieve($id);
        $total_seat_rows = 0;
        foreach ($seatClasses as $seatClass) {
            $total_seat_rows += $seatClass['total_seat_rows'];
        }

        return view('eventlist.details', compact('event', 'seatClasses', 'seats', 'total_seat_rows'));
    }

    public function deploy($id){
        $seatController = new SeatController();
        $event = Event::find($id);
        $seats = $seatController->retrieve($id);
        if (empty($seats)){
            return redirect()->route('eventlist')
                ->with('failure', 'Cannot deploy an event that has no seats.');
        }
        $event->deployed = true;
        $event->save();

        return redirect()->route('eventlist')
            ->with('success','Event deployed successfully');
    }

    public function seatDetails($eventId, $seatId){
        $seatController = new SeatController();
        $seatClassController = new SeatClassController();
        $seat = $seatController->retrieveOne($seatId);
        $seatClass = $seatClassController->retrieveOne($seat->seat_class_id);
        $event = Event::find($eventId);
        $rowString = EventController::numberToLetter($seat->seat_position_row);
        return view('eventlist.seat', compact('seat', 'seatClass', 'event', 'rowString'));
    }

    public function retrieveDeployed(){
        $event = Event::where('deployed', true)->orderBy('end_date')->get();
        return ($event);
    }

    public function indexDeployed(){
        $event = EventController::retrieveDeployed();
        return view('event', compact('event'));
    }

    public function showDetailsDeployed($id){
        $event = Event::find($id);
        if(!$event->deployed){
            return redirect()->route('event')
                ->with('error',"Event isn't live.");
        }
        $seatClassController = new SeatClassController();
        $seatController = new SeatController();
        $seatClasses = $seatClassController->retrieve($id);
        $seats = $seatController->retrieve($id);
        $total_seat_rows = 0;
        $dateTimeString = EventController::convertDateTimeToLocalFormat($event->end_date);
        foreach ($seatClasses as $seatClass) {
            $total_seat_rows += $seatClass['total_seat_rows'];
        }
        return view('details', compact('event', 'seatClasses', 'seats', 'total_seat_rows', 'dateTimeString'));
    }

    public function seatDetailsDeployed($eventId, $seatId){
        $seatController = new SeatController();
        $seatClassController = new SeatClassController();
        $seat = $seatController->retrieveOne($seatId);
        $seatClass = $seatClassController->retrieveOne($seat->seat_class_id);
        $event = Event::find($eventId);
        if(!$event->deployed){
            return redirect()->route('event')
                ->with('error',"Event isn't live.");
        }
        $rowString = EventController::numberToLetter($seat->seat_position_row);
        return view('buy-tickets', compact('seat', 'seatClass', 'event', 'rowString'));
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

    function convertDateTimeToLocalFormat($dateTimeString) {
        $dateTime = new DateTime($dateTimeString);
        $day = str_pad($dateTime->format('d'), 2, '0', STR_PAD_LEFT);
        $month = str_pad($dateTime->format('m'), 2, '0', STR_PAD_LEFT);
        $year = $dateTime->format('Y');
        $hours = str_pad($dateTime->format('H'), 2, '0', STR_PAD_LEFT);
        $minutes = str_pad($dateTime->format('i'), 2, '0', STR_PAD_LEFT);
        $monthName = $dateTime->format('F');

        $formattedDateTime = "$day $monthName $year, $hours:$minutes";

        return $formattedDateTime;
    }
}
