<?php


namespace App\Services;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Collection;

class ActivityService
{

    public function getAll(): Collection
    {
        return Activity::all();
    }

}
