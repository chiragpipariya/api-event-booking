<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Attendee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttendeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_create_attendee()
    {
        $response = $this->postJson('/api/attendees', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890'
        ]);

        $response->assertStatus(201)->assertJsonFragment(['message' => 'created successfully.']);
    }

    public function test_update_attendee()
    {
        $attendee = Attendee::factory()->create();
        $response = $this->putJson("/api/attendees/{$attendee->id}", [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '9999999999'
        ]);

        $response->assertStatus(200)->assertJsonFragment(['message' => 'updated successfully.']);
    }

    public function test_delete_attendee()
    {
        $attendee = Attendee::factory()->create();
        $response = $this->deleteJson("/api/attendees/{$attendee->id}");

        $response->assertStatus(200)->assertJsonFragment(['message' => 'deleted successfully.']);
    }

    public function test_attendee_validation_error()
    {
        $response = $this->postJson('/api/attendees', []);
        $response->assertStatus(422)->assertJsonValidationErrors(['name', 'email', 'phone']);
    }
}
