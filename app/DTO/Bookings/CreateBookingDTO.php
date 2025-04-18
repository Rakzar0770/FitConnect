<?php

namespace App\DTO\Bookings;

class CreateBookingDTO
{
    public function __construct(
        private int $activity_id,
        private int $branch_id,
        private int $trainer_id,
        private string $booked_at
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

    public function getBookedAt(): string
    {
        return $this->booked_at;
    }

    public function getTrainerId(): int
    {
        return $this->trainer_id;
    }

    public function getBranchId(): int
    {
        return $this->branch_id;
    }

    public function getActivityId(): int
    {
        return $this->activity_id;
    }

}
