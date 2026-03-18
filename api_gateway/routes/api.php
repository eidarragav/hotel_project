<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomServiceController;
use App\Http\Controllers\ReservationServiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->middleware("auth:sanctum");


Route::get("/rooms", [RoomServiceController::class, "index"]);
Route::post("/rooms", [RoomServiceController::class, "store"]);
Route::put("/rooms/{id}", [RoomServiceController::class, "update"]);
Route::delete("/rooms/{id}", [RoomServiceController::class, "destroy"]);

Route::get("/reservations", [ReservationServiceController::class, "index"]);
Route::post("/reservations", [ReservationServiceController::class, "store"]);
Route::put("/reservations/{id}", [ReservationServiceController::class, "update"]);
Route::delete("/reservations/{id}", [ReservationServiceController::class, "destroy"]);



