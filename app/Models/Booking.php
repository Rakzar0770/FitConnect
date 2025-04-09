<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Разрешаем массовое присвоение для указанных полей
    protected $fillable = [
        'user_id',
        'activity_id',
        'branch_id',
        'trainer_id',
        'booked_at',
    ];

    // Отношения
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
