<?php

namespace App\Http\Requests;

use App\DTO\Bookings\CreateBookingDTO;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
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
        return new CreateBookingDTO(
            activity_id: $this['activity_id'],
            branch_id: $this['branch_id'],
            trainer_id: $this['trainer_id'],
            booked_at: $this['booked_at']
        );
    }
}
