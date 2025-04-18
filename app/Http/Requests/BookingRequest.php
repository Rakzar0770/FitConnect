<?php

namespace App\Http\Requests;

use App\DTO\Bookings\CreateBookingDTO;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Определяет, может ли пользователь выполнять этот запрос.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации.
     */
    public function rules(): array
    {
        return [
            'activity_id' => ['required', 'exists:activities,id'],
            'branch_id'   => ['required', 'exists:branches,id'],
            'trainer_id'  => ['required', 'exists:trainers,id'],
            'booked_at'   => ['required', 'date'],
        ];
    }
    public function messages(): array
    {
        return [
            'booked_at.required' => 'Вы не указали дату и время',
        ];
    }

    public function getInputDTO(): CreateBookingDTO
    {
        $validated = $this->validated();

        return new CreateBookingDTO(
            activity_id: $validated['activity_id'],
            branch_id: $validated['branch_id'],
            trainer_id: $validated['trainer_id'],
            booked_at: $validated['booked_at']
        );
    }
}
