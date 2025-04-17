<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Event;

class EventTest extends TestCase
{ 
    use RefreshDatabase;

    public function test_it_can_list_events()
    { 
        $response = $this->getJson('/api/events');
        $response->assertStatus(200)->assertJsonStructure(['data', 'message', 'status']);
    }

    public function test_it_can_create_event_with_valid_data()
    {
        $data = [
            'title' => 'Tech Conf',
            'description' => 'Annual tech conference',
            'date' => now()->addDays(10)->toDateString(),
            'country' => 'India',
            'capacity' => 2
        ];

        $response = $this->postJson('/api/events', $data);
        $response->assertStatus(200)->assertJson(['status' => true, 'message' => 'Event created successfully.']);
    }


    public function test_it_fails_to_create_event_with_invalid_data()
    {
        $response = $this->postJson('/api/events', []);
        $response->assertStatus(422)->assertJson(['status' => false]);
    }


    public function test_it_can_show_event()
    {
        $event = Event::factory()->create();
        $response = $this->getJson("/api/events/{$event->id}");
        $response->assertStatus(200)->assertJson(['status' => true]);
    }

}
