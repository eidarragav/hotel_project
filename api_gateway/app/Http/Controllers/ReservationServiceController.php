<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Reservation;

class ReservationServiceController extends Controller
{
    public function index(){
        $response = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->get(env("RESERVATION_ENDPOINT"));

        return [
            "status" => $response->status(),
            "body" => $response->body()
        ];
    }

    public function store(Request $request){
        $validar_room = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->get(env("VALIDATE_ROOM")."/".$request->room_id);
        
        if($validar_room->status() == 404){
            return response()->json(["mensaje" => "no existe"]);
        }

        if($validar_room->status() == 403){
            return response()->json(["mensaje" => "no disponibilidad"]);   
        }

        $response = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->post(env("RESERVATION_ENDPOINT"), [
            "room_id" => $request->room_id,
            "nights" => $request->nights,
            "total_price" => $request->total_price,
        ]);

        $descontar_habitaciones = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->get(env("DESCONTAR_HABITACION")."/".$request->room_id);

        return [
            "status" => $response->status(),
            "body" => $response->body()
        ];
    }


    public function update(Request $request, $id){

        $response = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->put(env("RESERVATION_ENDPOINT"."/".$id), [
            "room_id" => $request->room_id,
            "nights" => $request->nights,
            "total_price" => $request->total_price,
        ]);

        return [
            "status" => $response->status(),
            "body" => $response->body()
        ];
    }

    public function destroy($id){

        $response = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->delete(env("RESERVATION_ENDPOINT"."/".$id));

        return [
            "status" => $response->status(),
            "body" => $response->body()
        ];
    }
}
