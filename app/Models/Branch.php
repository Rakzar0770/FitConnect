<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // Отношение с организацией
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // Отношение с активностями
    public function activities()
    {
        return $this->belongsToMany(Activity::class)->withTimestamps();
    }

    // Отношение с тренерами
    public function trainers()
    {
        return $this->belongsToMany(Trainer::class)->withTimestamps();
    }
}
