<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'https://placehold.co/600x400',
            'number' => $this->faker->unique()->numberBetween(101, 999), // Unique room number
            'type' => $this->faker->randomElement(['single', 'double', 'suite']), // Random room type
            'capacity' => $this->faker->numberBetween(1, 4), // Random room capacity between 1 and 4
            'price' => $this->faker->numberBetween(50, 500), // Random price between 50 and 500 (you can adjust the range)
            'description' => $this->faker->text()
        ];
    }
}
