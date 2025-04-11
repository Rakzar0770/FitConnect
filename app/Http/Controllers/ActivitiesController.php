<?php


namespace App\Http\Controllers;

use App\Services\ActivityService;
use App\Services\OrganizationService;
use Illuminate\View\View;
use App\Models\Activity;

class ActivitiesController extends Controller
{

    public function __construct(protected ActivityService $activitiesService, protected OrganizationService $organizationService)
    {

    }


    public function index(): View
    {
        $activities = $this->activitiesService->getAll();
        return view('activities.index', compact('activities'));
    }


    public function show(Activity $activity): View
    {

        $data = $this->organizationService->getByActivity($activity);

        return view('activities.show', $data);
    }
}
