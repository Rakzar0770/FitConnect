<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [
        'user_id',
        'activity_id',
        'branch_id',
        'trainer_id',
        'booked_at',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }


    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }


    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }
}
