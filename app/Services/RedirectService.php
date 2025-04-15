<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class RedirectService
{

    public function setStatus(string $route, string $status): RedirectResponse
    {
        return Redirect::route($route)->with('status', $status);
    }

}
