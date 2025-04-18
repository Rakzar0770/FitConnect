<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $search = ['name','description'];
    use HasFactory;


    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class)->withTimestamps();
    }


    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class);
    }
}
