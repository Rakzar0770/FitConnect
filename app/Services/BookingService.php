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
        // Добавляем user_id текущего пользователя
        $bookingData = [
            'user_id' => Auth::id(),
            'activity_id' => $data->activity_id,
            'branch_id' => $data->branch_id,
            'trainer_id' => $data->trainer_id,
            'booked_at' => $data->booked_at,
        ];
        $isTimeAvailable = !Booking::where('trainer_id', $data->trainer_id)
            ->where('booked_at', $data->booked_at)
            ->exists();

        if (!$isTimeAvailable) {
            throw new \Exception('Это время уже занято. Пожалуйста, выберите другое время.');
        }

        // Создание записи
        Booking::create($bookingData);
    }
}
