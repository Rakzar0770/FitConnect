<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Request; // Импортируем класс Request
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BookingsController extends Controller
{

    public function __construct(protected BookingService $bookingService)
    {

    }


    public function create(int $branch_id = null): View
    {

        $branches = $this->bookingService->getAll();

        $selectedBranch = $branch_id ? $this->bookingService->getBranchById($branch_id) : null;

        return view('bookings.create', compact('branches', 'selectedBranch'));
    }


    public function store(Request $request): RedirectResponse
    {
        try {
            $requestData = $request->all();

            $this->bookingService->createBooking($requestData);

            return redirect()->route('users.dashboard')->with('success', 'Вы успешно записались!');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['booked_at' => $e->getMessage()]);
        }
    }
}
