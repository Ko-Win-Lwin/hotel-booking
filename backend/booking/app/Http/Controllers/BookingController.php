<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return Booking::all();
    }

    public function getUserBookings(Request $request)
    {

        $authorization = $request->header('authorization');  // Get the logged-in user's ID
        $user_id = null;

        if ($authorization) {
            $parts = explode(' ', $authorization);
            if (count($parts) === 2) {
                $user_id = $parts[1];
            }
        }

        if (!$user_id || !User::find($user_id)) {
            return response()->json(['message' => "Unauthorized", 'user_id' => $user_id], 403);
        }

        // Fetch the bookings for this user
        $bookings = Booking::where('user_id', $user_id)->get();

        return response()->json($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $authorization = $request->header('Authorization');

        $user_id = null;

        if ($authorization) {
            $parts = explode(' ', $authorization);
            if (count($parts) === 2) {
                $user_id = $parts[1];
            }
        }

        if (!$user_id || !User::find($user_id)) {
            return response()->json(['message' => "Unauthorized", 'user_id' => $user_id], 403);
        }

        $attributes = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1'
        ]);

        if ($attributes->fails()) {
            return response()->json([
                'errors' => $attributes->errors(),
            ], 422);
        }

        $booking = Booking::create([
            'user_id' => intval($user_id),
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'number_of_guests' => $request->number_of_guests,
            'status' => 'booked'
        ]);

        return response()->json([
            'message' => "Booking Created Successfully",
            'booking' => $booking
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        $authorization = $request->header('Authorization');

        $user_id = null;

        if ($authorization) {
            $parts = explode(' ', $authorization);
            if (count($parts) === 2) {
                $user_id = $parts[1];
            }
        }

        if (!$user_id || !User::find($user_id)) {
            return response()->json(['message' => "Unauthorized", 'user_id' => $user_id], 403);
        }

        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        if ($booking->user_id != $user_id) {
            return response()->json(['message' => 'You are not authorized to delete this booking'], 403);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
