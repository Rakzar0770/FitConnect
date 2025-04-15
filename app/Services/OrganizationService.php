<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Organization;
use Illuminate\Support\Collection;

class OrganizationService
{

    public function getAll(): Collection
    {
        return Organization::all();
    }

    public function getByActivity(Activity $activity): array
    {
        $organizations = $activity->branches()
            ->with('organization')
            ->get()
            ->pluck('organization')
            ->unique();

        return [
            //'activity' => $activity,
            'organizations' => $organizations,
        ];
    }
}
