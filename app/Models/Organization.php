<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    // Отношение с филиалами
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    // Отношение с тренерами (через филиалы)
    public function trainers()
    {
        return $this->hasManyThrough(
            Trainer::class, // Целевая модель
            Branch::class,  // Промежуточная модель
            'organization_id', // Внешний ключ в промежуточной модели
            'id',             // Первичный ключ в целевой модели
            'id',             // Первичный ключ в текущей модели
            'id'              // Внешний ключ в целевой модели
        );
    }
}
