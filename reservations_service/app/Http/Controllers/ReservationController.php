<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();

        return response()->json(["Reservas" => $reservations]);
    }

    /**
     * reservations the form for creating a new resource.
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
        $reservation = new Reservation();

        $reservation->room_id = $request->room_id;
        $reservation->nights = $request->nights;
        $reservation->total_price = $request->total_price;

        $reservation->save();

        return response()->json(["mensaje" => "creado", "reserva" => $reservation]);
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
        $reservation = Reservation::find($id);

        $reservation->room_id = $request->room_id;
        $reservation->nights = $request->nights;
        $reservation->total_price = $request->total_price;

        $reservation->save();

        $reservation->save();

        return response()->json(["mensaje" => "editado", "reserva" => $reservation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        
        return response()->json(["mensaje" => "eliminado"]);
    }
}
