<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class UsersController extends Controller
{
    public function dashboard(): View
    {

        $bookings = auth()->user()->bookings()->latest()->get();

        return view('users.dashboard', compact('bookings'));
    }
}
