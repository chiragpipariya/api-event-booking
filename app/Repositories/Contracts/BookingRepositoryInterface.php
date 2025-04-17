<?php

namespace App\Repositories\Contracts;
 
use App\Models\Booking;

interface BookingRepositoryInterface {

    public function all();
    public function create(array $data): Booking;
    public function isAlreadyBooked(int $eventId, int $attendeeId): bool;
    public function isEventFull(int $eventId): bool;
    public function delete($id);
}
