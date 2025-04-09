<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Создаем организации
        \App\Models\Organization::factory(5)->create()->each(function ($organization) {
            // Создаем филиалы для каждой организации
            $branches = \App\Models\Branch::factory(3)->create(['organization_id' => $organization->id]);

            // Привязываем активности к филиалам
            $activities = \App\Models\Activity::factory(5)->create();
            foreach ($branches as $branch) {
                $branch->activities()->attach($activities->random(rand(1, 5))->pluck('id'));
            }
        });

        // Создаем тренеров
        \App\Models\Trainer::factory(10)->create();

        // Создаем пользователей и записи
        \App\Models\User::factory(10)->create()->each(function ($user) {
            \App\Models\Booking::factory(rand(1, 3))->create(['user_id' => $user->id]);
        });
    }
}
