<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Assuming you're using UserFactory for users
            'room_id' => Room::factory(), // Assuming you're using RoomFactory for rooms
            'check_in_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'check_out_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'number_of_guests' => $this->faker->numberBetween(1, 5), // Number of guests
            'status' => $this->faker->randomElement(['booked', 'cancelled']), // Can be either booked or cancelled
        ];
    }
}
