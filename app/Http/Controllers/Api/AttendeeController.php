<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendeeRequest;
use App\Http\Requests\UpdateAttendeeRequest;
use App\Services\AttendeeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;


 
class AttendeeController extends Controller
{
    protected $service;

    public function __construct(AttendeeService $service)
    {
        $this->service = $service;
    }

 
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'List fetched.',
            'data' => $this->service->getAll()
        ]);
    }
 
    public function store(StoreAttendeeRequest $request)
    { 
        return response()->json([
            'status' => true,
            'message' => 'created successfully.',
            'data' => $this->service->create($request->validated())
        ], 201);
    }

    public function show($id)
    {
        return response()->json([
            'status' => true,
            'message' => 'get successful.',
            'data' => $this->service->getById($id)
        ]);
    }

    public function update(UpdateAttendeeRequest $request, $id)
    {
        return response()->json([
            'status' => true,
            'message' => 'updated successfully.',
            'data' => $this->service->update($id, $request->validated())
        ]);
    }

    public function destroy($id)
    { 
        try {
            $this->service->delete($id);
            return response()->json([
                'data' => null,
                'message' => 'Attendee deleted successfully.',
                'status' => true,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'data' => null,
                'message' => 'Attendee not found.',
                'status' => false,
            ], 404);
        }
 
    }
}

