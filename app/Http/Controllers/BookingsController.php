<?php

namespace App\Http\Controllers;

use App\DTO\Bookings\CreateBookingDTO;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

    public function dashboard(): View
    {
        $user = Auth::user();

        // Получаем все записи пользователя
        $bookings = $user->bookings()->with(['activity', 'branch', 'trainer'])->get();

        // Разделяем на будущие и прошедшие записи
        $upcomingBookings = $bookings->filter(function ($booking) {
            return $booking->booked_at > now();
        })->sortBy('booked_at'); // Сортировка по времени (ближайшие первыми)

        $pastBookings = $bookings->filter(function ($booking) {
            return $booking->booked_at <= now();
        })->sortByDesc('booked_at'); // Сортировка по времени (недавние первыми)

        // Передаем данные в представление
        return view('users.dashboard', compact('upcomingBookings', 'pastBookings'));
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        // Проверяем, принадлежит ли запись текущему пользователю
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('users.dashboard')->withErrors(['error' => 'Вы не можете удалить эту запись.']);
        }

        // Удаляем запись
        $booking->delete();

        return redirect()->route('users.dashboard')->with('success', 'Запись успешно удалена.');
    }
}
