<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Room::all();
    }

    public function getAvailableRooms(Request $request)
    {

        $attributes = Validator::make($request->query(), [
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1',
        ]);



        $checkIn = $request->query('check_in_date');
        $checkOut = $request->query('check_out_date');
        $numberOfGuests = $request->query('number_of_guests');

        $availableRooms = Room::whereNotIn('id', function ($query) use ($checkIn, $checkOut) {
            $query->select('room_id')
                ->from('bookings')
                ->where(function ($query) use ($checkIn, $checkOut) {
                    $query->whereBetween('check_in_date', [$checkIn, $checkOut])
                        ->orWhereBetween('check_out_date', [$checkIn, $checkOut])
                        ->orWhere(function ($query) use ($checkIn, $checkOut) {
                            $query->where('check_in_date', '<', $checkIn)
                                ->where('check_out_date', '>', $checkOut);
                        });
                });
        })
            ->where('capacity', '>=', $numberOfGuests)  // Filter rooms based on number of guests
            ->get();

        if (!$availableRooms) {
            return response()->json([
                "message" => 'No Room Found!'
            ]);
        }

        return response()->json([
            'rooms' => $availableRooms,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
