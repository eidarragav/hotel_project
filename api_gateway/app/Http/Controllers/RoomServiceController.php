<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoomServiceController extends Controller
{
    public function index(){
        $response = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->get(env("ROOM_ENDPOINT"));

        return [
            "status" => $response->status(),
            "body" => $response->body()
        ];
    }

    public function store(Request $request){
        $response = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->post(env("ROOM_ENDPOINT"), [
            "type" => $request->type,
            "price" => $request->price,
            "available_rooms" => $request->available_rooms,
        ]);

        return [
            "status" => $response->status(),
            "body" => $response->body()
        ];
    }


    public function update(Request $request, $id){

        $response = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->put(env("ROOM_ENDPOINT"."/".$id), [
            "type" => $request->type,
            "price" => $request->price,
            "available_rooms" => $request->available_rooms,
        ]);

        return [
            "status" => $response->status(),
            "body" => $response->body()
        ];
    }

    public function destroy($id){

        $response = Http::withHeaders([
            "Authorization" => env("TOKEN")
        ])->delete(env("ROOM_ENDPOINT"."/".$id));

        return [
            "status" => $response->status(),
            "body" => $response->body()
        ];
    }
}
