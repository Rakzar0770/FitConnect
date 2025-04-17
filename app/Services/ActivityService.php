<?php


namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Collection;

class ActivityService
{
    public function __construct(protected OrganizationService $organizationService)
    {
    }

    public function getActivity(int $activityId): Activity
    {
        return Activity::findOrFail($activityId);
    }

    public function getAll(): Collection
    {
        return Activity::all();
    }
}
