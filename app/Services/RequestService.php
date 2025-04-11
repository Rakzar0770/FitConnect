<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RequestService
{

    public function validateBookingData(array $data): array
    {
        $rules = [
            'activity_id' => 'required|exists:activities,id',
            'branch_id' => 'required|exists:branches,id',
            'trainer_id' => 'required|exists:trainers,id',
            'booked_at' => 'required|date',
        ];

        $messages = [
            'booked_at.required' => 'Вы не указали дату и время',
        ];


        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
