<?php


namespace App\Http\Controllers;

use App\Services\ActivityService;
use Illuminate\View\View;
use App\Models\Activity;

class ActivitiesController extends Controller
{

    public function __construct(protected ActivityService $activitiesService)
    {

    }


    public function index(): View
    {
        $activities = $this->activitiesService->getAll();
        return view('activities.index', compact('activities'));
    }


    public function show(Activity $activity): View
    {

        $data = $this->activitiesService->getWithOrganizations($activity);

        return view('activities.show', $data);
    }
}
