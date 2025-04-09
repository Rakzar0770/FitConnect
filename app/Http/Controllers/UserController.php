<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        // Получаем записи пользователя, отсортированные по времени создания (от новых к старым)
        $bookings = auth()->user()->bookings()->latest()->get();

        return view('users.dashboard', compact('bookings'));
    }
}
