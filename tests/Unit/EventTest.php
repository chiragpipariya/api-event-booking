<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Event;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    } 

use RefreshDatabase;

    public function test_it_can_list_events()
    {
        Event::factory()->count(3)->create();
        $response = $this->getJson('/api/events');
        $response->assertStatus(200)->assertJsonStructure(['data', 'message', 'status']);
    }

    public function test_it_can_create_event_with_valid_data()
    {
        $data = [
            'name' => 'Tech Conf',
            'description' => 'Annual tech conference',
            'date' => now()->addDays(10)->toDateString(),
            'country' => 'India',
            'capacity' => 500
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

    public function test_it_can_update_event()
    {
        $event = Event::factory()->create();

        $data = ['name' => 'Updated Name', 'description' => 'Updated Desc', 'date' => now()->toDateString(), 'country' => 'UK', 'capacity' => 250];
        $response = $this->putJson("/api/events/{$event->id}", $data);
        $response->assertStatus(200)->assertJson(['status' => true]);
    }

    public function test_it_can_delete_event()
    {
        $event = Event::factory()->create();
        $response = $this->deleteJson("/api/events/{$event->id}");
        $response->assertStatus(200)->assertJson(['message' => 'Event deleted successfully.']);
    }
}
