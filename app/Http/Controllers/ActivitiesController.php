<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('activities.index', compact('activities'));
    }

    public function show(Activity $activity)
    {
        $organizations = $activity->branches()->with('organization')->get()->pluck('organization')->unique();
        return view('activities.show', compact('activity', 'organizations'));
    }
}
