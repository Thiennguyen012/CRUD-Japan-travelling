<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;

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
            'hotel_id' => Hotel::query()->inRandomOrder()->value('hotel_id'),
            'customer_name' => $this->faker->name(),
            'customer_contact' => $this->faker->phoneNumber(),
            'checkin_time' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'checkout_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
