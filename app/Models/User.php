<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{

    use HasFactory;
    use Notifiable;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
