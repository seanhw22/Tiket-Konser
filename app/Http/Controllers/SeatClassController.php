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

    public function storeOne($seatClassData, $event_id){
        $class = SeatClass::create([
            "event_id" => $event_id,
            "seat_class" => $seatClassData['seat_class'],
            "price" => $seatClassData['price'],
        ]);
    }

    public function retrieve($event_id){
        $seatClasses = SeatClass::where('event_id', $event_id)->get();
        $seatClassArray = $seatClasses->toArray();
        return $seatClassArray;
    }

    public function update(Request $request, $event_id){
        $seatClassIdsInRequest = array_column($request->seatclass, 'id');
        $seatClassIdsInDatabase = SeatClass::where('event_id', $event_id)->pluck('id')->toArray();

        $seatClassIdsToRemove = array_diff($seatClassIdsInDatabase, $seatClassIdsInRequest);

        SeatClass::whereIn('id', $seatClassIdsToRemove)->delete();

        foreach ($request->seatclass as $seatClassData) {
            $id = $seatClassData['id'];

            if ($id == "id") {
                SeatClassController::storeOne($seatClassData, $event_id);
            } 
            else {
                $update = [
                    "seat_class" => $seatClassData['seat_class'],
                    "price" => $seatClassData['price'],
                ];
                SeatClass::whereId($id)->update($update);
            }
        }
    }

    public function destroy($id){
        $seatclass = SeatClass::find($id);
        $seatclass->delete();
    }
}
