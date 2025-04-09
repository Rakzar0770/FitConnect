<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'activity_id' => \App\Models\Activity::factory(),
            'branch_id' => \App\Models\Branch::factory(),
            'trainer_id' => \App\Models\Trainer::factory(),
            'booked_at' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
        ];
    }
}
