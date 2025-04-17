<?php

namespace App\Repositories\Contracts;
 
use App\Models\Booking;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BookingRepositoryInterface {

    public function all();
    public function create(array $data): Booking;
    public function isAlreadyBooked(int $eventId, int $attendeeId): bool;
    public function isEventFull(int $eventId): bool;
    public function delete($id);
    public function paginateAndFilter(array $filters): LengthAwarePaginator;
}
