<?php

namespace App\DTO\Bookings;

class CreateBookingDTO
{
    public function __construct(
        public int $activity_id,
        public int $branch_id,
        public int $trainer_id,
        public string $booked_at
    ) {
    }
    
    public static function fromArray(array $data): self
    {
        return new self(
            activity_id: $data['activity_id'],
            branch_id: $data['branch_id'],
            trainer_id: $data['trainer_id'],
            booked_at: $data['booked_at']
        );
    }
}
