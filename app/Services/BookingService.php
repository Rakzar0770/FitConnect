<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public function __construct(protected RequestService $requestService)
    {
    }

    public function getAll(): Collection
    {
        return Branch::with(['activities', 'trainers'])->get();
    }

    public function getBranchById(int $branchId)
    {
        return Branch::with(['activities', 'trainers'])->findOrFail($branchId);
    }

    public function createBooking(array $data): void
    {
        $validated = $this->requestService->validateBookingData($data);

        $validated['user_id'] = Auth::id();

        $isTimeAvailable = !Booking::where('trainer_id', $validated['trainer_id'])
            ->where('booked_at', $validated['booked_at'])
            ->exists();

        if (!$isTimeAvailable) {
            throw new \Exception('Это время уже занято. Пожалуйста, выберите другое время.');
        }

        Booking::create($validated);
    }
}
