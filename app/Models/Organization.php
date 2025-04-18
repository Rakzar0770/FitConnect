<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasManyThrough;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $search = ['name'];

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

//    public function trainers(): HasManyThrough
//    {
//        return $this->hasManyThrough(
//            Trainer::class,
//            Branch::class,
//            'organization_id',
//            'id',
//            'id',
//            'id'
//        );
//    }

    // Связь с тренерами (через филиалы)
    public function trainers()
    {
        return $this->hasManyThrough(Trainer::class, Branch::class);
    }

    // Связь с активностями (через филиалы)
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'branch_activity')
            ->using(BranchesActivity::class)
            ->withPivot('branch_id');
    }
}
