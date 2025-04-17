<?php

namespace App\Services;

use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Models\Booking;

class BookingService
{
    protected BookingRepositoryInterface $bookingRepo;

    public function __construct(BookingRepositoryInterface $bookingRepo) {
        $this->bookingRepo = $bookingRepo;
    }

    public function getAll()
    {
        return $this->bookingRepo->all();
    }

    public function bookEvent(array $data): Booking|string {
        if ($this->bookingRepo->isAlreadyBooked($data['event_id'], $data['attendee_id'])) {
            return 'Attendee already booked this event.';
        }

        if ($this->bookingRepo->isEventFull($data['event_id'])) {
            return 'Event is fully booked.';
        }

        return $this->bookingRepo->create($data);
    }

    public function delete($id)
    {
        return $this->bookingRepo->delete($id);
    }
}
