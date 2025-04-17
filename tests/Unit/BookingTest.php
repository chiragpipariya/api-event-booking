<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Attendee;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_attendee_can_book_event_successfully() {
        $event = Event::factory()->create(['capacity' => 5]);
        $attendee = Attendee::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(200)
            ->assertJson(['status' => true, 'message' => 'Booking successful.']);
    }

    public function test_cannot_book_event_twice() {
        $event = Event::factory()->create(['capacity' => 5]);
        $attendee = Attendee::factory()->create();
        Booking::create(['event_id' => $event->id, 'attendee_id' => $attendee->id]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(422)
            ->assertJson(['status' => false, 'message' => 'Attendee already booked this event.']);
    }

    public function test_cannot_overbook_event() {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee1 = Attendee::factory()->create();
        $attendee2 = Attendee::factory()->create();

        $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee1->id,
        ]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee2->id,
        ]);

        $response->assertStatus(422)
            ->assertJson(['status' => false, 'message' => 'Event is fully booked.']);

        $this->assertEquals(1, Booking::where('event_id', $event->id)->count());
    }
}
