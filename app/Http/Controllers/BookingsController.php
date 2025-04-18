<?php

namespace App\Http\Controllers;

use App\DTO\Bookings\CreateBookingDTO;
use App\Http\Requests\BookingRequest;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class BookingsController extends Controller
{
    public function __construct(protected BookingService $bookingService)
    {
    }

    public function view(Request $request): View
    {
        $branch_id = $request->input('branch_id');
        $branches = $this->bookingService->getAll();
        $selectedBranch = $branch_id ? $this->bookingService->getBranchById($branch_id) : null;

        return view('bookings.create', compact('branches', 'selectedBranch'));
    }

    public function store(BookingRequest $request): RedirectResponse
    {
        try {
            $this->bookingService->createBooking($request->getInputDTO());

            return redirect()->route('users.dashboard')->with('success', 'Вы успешно записались!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['booked_at' => $e->getMessage()]);
        }
    }
}
