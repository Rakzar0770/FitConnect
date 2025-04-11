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


    public function getWithOrganizations(Activity $activity): array
    {

        $organizations = $activity->branches()
            ->with('organization')
            ->get()
            ->pluck('organization')
            ->unique();

        return [
            'activity' => $activity,
            'organizations' => $organizations,
        ];
    }
}
