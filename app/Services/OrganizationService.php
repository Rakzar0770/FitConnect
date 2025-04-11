<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Collection;

class OrganizationService
{

    public function getByActivity(Activity $activity): Collection
    {
        return $activity->branches()
            ->with('organization')
            ->get()
            ->pluck('organization')
            ->unique();
    }
}
