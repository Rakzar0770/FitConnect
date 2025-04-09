<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainerFactory extends Factory
{
    protected $model = \App\Models\Trainer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'telegram_chat_id' => $this->faker->randomNumber(8),
        ];
    }

    /**
     * Настройка отношений с филиалами.
     */
    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Trainer $trainer) {
            // Привязываем тренера к случайным филиалам
            $branches = Branch::inRandomOrder()->take(rand(1, 5))->get();
            foreach ($branches as $branch) {
                $branch->trainers()->attach($trainer->id);
            }
        });
    }
}
