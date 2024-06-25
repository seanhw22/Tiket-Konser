<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\SeatClassController;
use App\Http\Controllers\SeatController;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::all();
        $search ='';
        $deployed = 0;
        return view('eventlist.index', compact('event', 'search', 'deployed'));
    }

    public function search(Request $request){
        $search = $request->search;
        $deployed = $request->deployed;
        if ($search === '') {
            return redirect()->route('eventlist');
        }
        $event = Event::where('event_name', 'like', '%' . $request->search . '%')
            ->orWhere('event_desc', 'like', '%' . $request->search . '%')
            ->get();
        if ($event->isEmpty()) {
            return redirect()->route('eventlist')
                ->with('failure','Event does not exist.');
        }
        return view('eventlist.index', compact('event', 'search', 'deployed'));
    }

    public function sortAsc(Request $request)
    {
        $search = $request->search;
        $deployed = $request->deployed;
        $event = Event::where('event_name', 'like', '%' . $search . '%')
            ->orWhere('event_desc', 'like', '%' . $search . '%')
            ->orderBy('event_name', 'asc')->get();
        return view('eventlist.index', compact('event', 'search', 'deployed'));
    }
    public function sortDesc(Request $request)
    {
        $search = $request->search;
        $deployed = $request->deployed;
        $event = Event::where('event_name', 'like', '%' . $search . '%')
            ->orWhere('event_desc', 'like', '%' . $search . '%')
            ->orderBy('event_name', 'desc')->get();
        return view('eventlist.index', compact('event', 'search', 'deployed'));
    }

    public function retrieveDeployedAdmin(Request $request){
        $search = $request->search;
        $deployed = $request->deployed;
        if ($deployed == 0) {
            $deployed = 1;
            $event = Event::where(function ($query) use ($search) {
            $query->where('event_name', 'like', '%' . $search . '%')
                ->orWhere('event_desc', 'like', '%' . $search . '%');
            })
            ->where('deployed', true)
            ->get();
        }
        else if ($deployed == 1) {
            $deployed = 0;
            $event = Event::where(function ($query) use ($search) {
            $query->where('event_name', 'like', '%' . $search . '%')
                    ->orWhere('event_desc', 'like', '%' . $search . '%');
            })
            ->where('deployed', false)
            ->get();
        }
        return view('eventlist.index', compact('event', 'search', 'deployed'));
    }
    public function create()
    {
        return view("eventlist.create");
    }
    
    public function store(Request $request){
        $request->seatclass = array_filter($request->seatclass, function ($value) {
            return !is_null($value);
        });
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

        $desc = EventController::insert_br($request->event_desc);

        $event = Event::create([
            "event_name"=> $request->event_name,
            "event_desc"=> $desc,
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

    public function retrieveAll(){
        $events = Event::all();
        return $events;
    }

    public function retrieveOne($id){
        $event = Event::find($id);
        return $event;
    }

    public function edit($id){
        $event = Event::find($id);
        if ($event == null){
            return redirect()->route('eventlist')
                ->with('failure','Event does not exist.');
        }
        $event->event_desc = EventController::remove_br($event->event_desc);
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
        $request->seatclass = array_filter($request->seatclass, function ($value) {
            return !is_null($value);
        });
        $event = Event::find($id);
        if ($event == null){
            return redirect()->route('eventlist')
                ->with('failure','Event does not exist.');
        }
        if ($event->deployed == true){
            return redirect()->route('eventlist')
                ->with('failure','Event already deployed, cannot edit an event that has been deployed.');
        }
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

        $desc = EventController::insert_br($request->event_desc);

        $update = [
            'event_name'=> $request->event_name,
            'event_desc'=> $desc,
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
        if ($event == null){
            return redirect()->route('eventlist')
                ->with('failure','Event does not exist.');
        }
        if ($event->deployed == true){
            return redirect()->route('eventlist')
                ->with('failure','Event already deployed, cannot delete an event that has been deployed.');
        }
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
        if (Event::find($id) == null){
            return redirect()->route('eventlist')
                ->with('failure','Event does not exist.');
        }
        if (Event::find($id)->deployed == true){
            return redirect()->route('eventlist')
                ->with('failure','Event already deployed, cannot create seats for an event that has been deployed.');
        }
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
        if ($event == null){
            return redirect()->route('eventlist')
                ->with('failure','Event does not exist.');
        }
        if ($event->deployed == true){
            return redirect()->route('eventlist')
                ->with('failure','Event already deployed, cannot deploy an event that has been deployed.');
        }
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
        $buyerController = new BuyerController();
        $seat = $seatController->retrieveOne($seatId);
        $seatClass = $seatClassController->retrieveOne($seat->seat_class_id);
        $event = Event::find($eventId);
        $rowString = EventController::numberToLetter($seat->seat_position_row);
        $buyer = $buyerController->retrieve($seatId);
        return view('eventlist.seat', compact('seat', 'seatClass', 'event', 'rowString', 'buyer'));
    }

    public function retrieveDeployed(){
        $currentDate = Carbon::now();
        $event = Event::where('deployed', true)->where('end_date', '>=', $currentDate)->orderBy('end_date')->get();
        return ($event);
    }

    public function indexDeployed(){
        $event = EventController::retrieveDeployed();
        $search = '';
        return view('event', compact('event', 'search'));
    }

    public function searchDeployed(Request $request){
        $search = $request->search;
        $currentDate = Carbon::now();
        if ($search === '') {
            return redirect()->route('eventlist');
        }
        $event = Event::where(function ($query) use ($search) {
            $query->where('event_name', 'like', '%' . $search . '%')
                ->orWhere('event_desc', 'like', '%' . $search . '%');
            })
            ->where('deployed', true)->where('end_date', '>=', $currentDate)->orderBy('end_date')
            ->get();
        if ($event->isEmpty()) {
            return redirect()->route('event')
                ->with('error','Event does not exist.');
        }
        return view('event', compact('event', 'search'));
    }

    public function sortAscDeployed(Request $request)
    {
        $search = $request->search;
        $currentDate = Carbon::now();
        $event = Event::where(function ($query) use ($search) {
            $query->where('event_name', 'like', '%' . $search . '%')
                ->orWhere('event_desc', 'like', '%' . $search . '%');
            })
            ->where('deployed', true)->where('end_date', '>=', $currentDate)->orderBy('end_date')
            ->orderBy('event_name', 'asc')
            ->get();
        return view('event', compact('event', 'search'));
    }
    public function sortDescDeployed(Request $request)
    {
        $search = $request->search;
        $currentDate = Carbon::now();
        $event = Event::where(function ($query) use ($search) {
            $query->where('event_name', 'like', '%' . $search . '%')
                ->orWhere('event_desc', 'like', '%' . $search . '%');
            })
            ->where('deployed', true)->where('end_date', '>=', $currentDate)->orderBy('end_date')
            ->orderBy('event_name', 'desc')
            ->get();
        return view('event', compact('event', 'search'));
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
        $dateTimeString = EventController::convertDateTimeToLocalFormat($event->event_date);
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
        if(!$seat->available){
            return redirect()->route('event.showdeployed', [$eventId, $seatId])
                ->with('error',"Seat isn't available.");
        }
        $rowString = EventController::numberToLetter($seat->seat_position_row);
        return view('buy-tickets', compact('seat', 'seatClass', 'event', 'rowString'));
    }

    public function buyTicket(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'event_id'=> 'required',
            'seat_id'=> 'required',
        ]);

        $seatController = new SeatController();
        $buyerController = new BuyerController();

        $seat = $seatController->retrieveOne($request->seat_id);
        if(!$seat->available){
            return redirect()->route('event.showdeployed', [$request->event_id, $request->seat_id])
                ->with('error',"Seat isn't available.");
        }
        
        $buyer_id = $buyerController->store($request);
        $seatController->updateAvailability($request->seat_id, $buyer_id);

        return redirect()->route('event.confirmed', [$request->event_id, $request->seat_id]);
    }

    public function showConfirmed(){
        return view('confirmed');
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
    function insert_br($text)
    {
        $text_with_br = preg_replace('/(?:\r\n|\r|\n)/', '<br>', $text);
        return $text_with_br;
    }
    function remove_br($text)
    {
        $text_with_line_breaks = preg_replace('/<br\s*\/?>/', "\n", $text);
        return $text_with_line_breaks;
    }
}
