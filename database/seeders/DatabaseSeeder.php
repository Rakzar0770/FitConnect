<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use App\Models\Branch;
use App\Models\Activity;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Создаем организации
        Organization::factory(5)->create()->each(function ($organization) {
            // Создаем филиалы для каждой организации
            $branches = Branch::factory(3)->create(['organization_id' => $organization->id]);

            // Привязываем активности к филиалам
            $activities = Activity::factory(5)->create();
            foreach ($branches as $branch) {
                $branch->activities()->attach($activities->random(rand(1, 5))->pluck('id'));
            }
        });

        // Создаем тренеров
        Trainer::factory(10)->create();

        // Создаем пользователей и записи
        User::factory(10)->create()->each(function ($user) {
            Booking::factory(rand(1, 3))->create(['user_id' => $user->id]);
        });
    }
}
