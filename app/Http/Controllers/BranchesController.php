<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Organization;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    public function index(Organization $organization)
    {
        $branches = $organization->branches()->with('activities', 'trainers')->get();
        return view('branches.index', compact('organization', 'branches'));
    }
}
