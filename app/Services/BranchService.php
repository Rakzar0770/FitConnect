<?php

namespace App\Services;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

class BranchService
{

    public function getBranchesByOrganization(Organization $organization): Collection
    {
        return $organization->branches()
            ->with('activities', 'trainers')
            ->get();
    }



}
