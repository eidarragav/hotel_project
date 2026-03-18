<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    //Metodo para saber si existe, si hay mas de una disponible y 
    //retornar el precio
    public function validate_room($id){
        $room = Room::find($id);

        //Si no existe :
        if(!$room){
            //Luego desde el gateway preguntaremos si la respuesta tiene 
            //codigo 404
            return response()->json(["mensaje"=> "no existe"], 404);
        }
        
        if($room->available_rooms < 1){
            return response()->json(["mensaje" => "no disponibilidad"], 403);
        }

        return response()->json(["price" => $room->price]);
    }

    //Para desonctar

    public function descontar_habitacion($id){
        $room = Room::find($id);

        $room->available_rooms = $room->available_rooms-1;

        $room->save();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();

        return response()->json(["Habitaciones" => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $room = new Room();

        $room->type = $request->type;
        $room->available_rooms = $request->available_rooms;
        $room->price = $request->price;

        $room->save();

        return response()->json(["mensaje" => "creado", "room" => $room]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $room = Room::find($id);

        $room->type = $request->type;
        $room->available_rooms = $request->available_rooms;
        $room->price = $request->price;

        $room->save();

        return response()->json(["mensaje" => "editado", "room" => $room]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();
        
        return response()->json(["mensaje" => "eliminado"]);
    }
}
