<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Services\OrganizationService;
use App\Models\Activity;
use Illuminate\Contracts\View\View;

class OrganizationsController extends Controller
{

    public function __construct(protected OrganizationService $organizationService) {}


    public function index(Activity $activity): View
    {

        $organizations = $this->organizationService->getByActivity($activity);

        return view('organizations.index', compact('activity', 'organizations'));
    }

    public function show(Organization $organization): View
    {

        $organizations = $this->organizationService->getAll($organization);

        return view('organization.index', compact('organization', 'organizations'));
    }
}
