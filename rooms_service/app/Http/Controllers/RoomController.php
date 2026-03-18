<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
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
