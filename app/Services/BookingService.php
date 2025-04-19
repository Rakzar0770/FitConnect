<?php

namespace App\Services;

use App\DTO\Bookings\CreateBookingDTO;
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


    public function createBooking(CreateBookingDTO $data): void
    {
        $bookingData = [
            'user_id' => Auth::id(),
            'activity_id' => $data->getActivityId(),
            'branch_id' => $data->getBranchId(),
            'trainer_id' => $data->getTrainerId(),
            'booked_at' => $data->getBookedAt(),
        ];
        $isTimeAvailable = !Booking::where('trainer_id', $data->getTrainerId())
            ->where('booked_at', $data->getBookedAt())
            ->exists();

        if (!$isTimeAvailable) {
            throw new \Exception('Это время уже занято. Пожалуйста, выберите другое время.');
        }

        Booking::create($bookingData);
    }
}
