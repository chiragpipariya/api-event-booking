<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventService;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 
 
class EventController extends Controller
{

    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(Request $request): JsonResponse
    { 
        $events = $this->eventService->getPaginated($request->all());
        return response()->json(['data' => $events, 'message' => 'List fetched successfully.', 'status' => true]);
    }

    public function store(StoreEventRequest $request)
    {
        $event = $this->eventService->create($request->validated());
        return response()->json(['data' => $event, 'message' => 'Event created successfully.', 'status' => true]);
    }

    public function show($id)
    {
        $event = $this->eventService->find($id);
        return response()->json(['data' => $event, 'message' => 'Event fetched successfully.', 'status' => true]);
    }

    public function update(UpdateEventRequest $request, $id)
    { 
        $event = $this->eventService->update($id, $request->validated());
        return response()->json(['data' => $event, 'message' => 'Event updated successfully.', 'status' => true]);
    }

    public function destroy($id)
    { 
        try {
            $this->eventService->delete($id);
            return response()->json([
                'data' => null,
                'message' => 'Event deleted successfully.',
                'status' => true,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'data' => null,
                'message' => 'Event not found.',
                'status' => false,
            ], 404);
        }
    }
}
