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
        $response = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->post(env("RESERVATION_ENDPOINT"), [
            "room_id" => $request->room_id,
            "nights" => $request->nights,
            "total_price" => $request->total_price,
        ]);

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
