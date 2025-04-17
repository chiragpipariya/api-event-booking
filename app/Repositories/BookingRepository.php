<?php 

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Event;
use App\Repositories\Contracts\BookingRepositoryInterface;

class BookingRepository implements BookingRepositoryInterface
{
    public function all()
    {
        return Booking::all();
    }

    public function create(array $data): Booking {
        return Booking::create($data);
    }

    public function isAlreadyBooked(int $eventId, int $attendeeId): bool {
        return Booking::where('event_id', $eventId)
            ->where('attendee_id', $attendeeId)
            ->exists();
    }

    public function isEventFull(int $eventId): bool {
        $event = Event::withCount('bookings')->findOrFail($eventId);
        return $event->bookings_count >= $event->capacity;
    }

    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        return $booking->delete();
    }
}