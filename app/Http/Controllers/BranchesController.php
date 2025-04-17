<?php

namespace App\Http\Controllers;

use App\Services\BranchService;
use App\Models\Organization;
use Illuminate\View\View;

class BranchesController extends Controller
{
    public function __construct(protected BranchService $branchService)
    {
    }

    public function index(Organization $organization): View
    {
        $branches = $this->branchService->getBranchesByOrganization($organization);
        return view('branches.index', compact('organization', 'branches'));
    }
}
