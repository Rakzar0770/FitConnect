<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Activity;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index(Activity $activity)
    {
        $organizations = $activity->branches()->with('organization')->get()->pluck('organization')->unique();
        return view('organizations.index', compact('activity', 'organizations'));
    }
}
