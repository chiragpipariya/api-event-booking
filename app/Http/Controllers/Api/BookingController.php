<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService) {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'List fetched.',
            'data' => $this->bookingService->getAll()
        ]);
    }

    public function store(StoreBookingRequest $request): JsonResponse {
        $result = $this->bookingService->bookEvent($request->validated());

        if (is_string($result)) {
            return response()->json(['data' => null, 'message' => $result, 'status' => false], 422);
        }

        return response()->json(['data' => $result, 'message' => 'Booking successful.', 'status' => true]);
    }

    public function destroy($id)
    { 
        try {
            $this->bookingService->delete($id);
            return response()->json([
                'data' => null,
                'message' => 'Booking deleted successfully.',
                'status' => true,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'data' => null,
                'message' => 'Booking not found.',
                'status' => false,
            ], 404);
        }
 
    }
}
