<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Define your API routes

Route::apiResource('bookings', BookingController::class);

Route::apiResource('rooms', RoomController::class);
Route::get('available-rooms', [RoomController::class, 'getAvailableRooms']);
Route::get("/my-bookings", [BookingController::class, 'getUserBookings']);


Route::post('/login', action: [AuthController::class, 'login']);
