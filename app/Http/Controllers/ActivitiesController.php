<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivitiesController extends Controller
{
    public function index(): View
    {
        $activities = Activity::all();
        return view('activities.index', compact('activities'));
    }

    public function show(Activity $activity): View
    {
        $organizations = $activity->branches()->with('organization')->get()->pluck('organization')->unique();
        return view('activities.show', compact('activity', 'organizations'));
    }
}
