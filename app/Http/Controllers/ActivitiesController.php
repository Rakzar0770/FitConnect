<?php


namespace App\Http\Controllers;

use App\Services\ActivityService;
use Illuminate\View\View;
use App\Models\Activity;

class ActivitiesController extends Controller
{
    protected ActivityService $activitiesService;

    public function __construct(ActivityService $activitiesService)
    {
        $this->activitiesService = $activitiesService;
    }


    public function index(): View
    {
        $activities = $this->activitiesService->getAllActivities();
        return view('activities.index', compact('activities'));
    }


    public function show($id): View
    {

        $activity = Activity::findOrFail($id);


        $data = $this->activitiesService->getActivityWithOrganizations($activity);

        return view('activities.show', $data);
    }
}
