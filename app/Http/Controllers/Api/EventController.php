<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventService;
use App\Http\Controllers\Controller;
 
class EventController extends Controller
{

    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return response()->json(['data' => $events, 'message' => 'List fetched successfully.', 'status' => true]);
    }

    public function store(StoreEventRequest $request)
    {
        $event = $this->eventService->createEvent($request->validated());
        return response()->json(['data' => $event, 'message' => 'Event created successfully.', 'status' => true]);
    }

    public function show(Event $event)
    {
        return response()->json(['data' => $event, 'message' => 'Event fetched successfully.', 'status' => true]);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $updated = $this->eventService->updateEvent($event, $request->validated());
        return response()->json(['data' => $updated, 'message' => 'Event updated successfully.', 'status' => true]);
    }

    public function destroy(Event $event)
    {
        $this->eventService->deleteEvent($event);
        return response()->json(['data' => null, 'message' => 'Event deleted successfully.', 'status' => true]);
    }
}
