<?php

namespace App\Repositories;

use App\Models\Attendee; 
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\AttendeeRepositoryInterface;

class AttendeeRepository implements AttendeeRepositoryInterface
{
    public function all()
    {
        return Attendee::all();
    }

    public function find($id)
    {
        return Attendee::findOrFail($id);
    }

    public function create(array $data)
    {
        return Attendee::create($data);
    }

    public function update($id, array $data)
    {
        $attendee = Attendee::findOrFail($id);
        $attendee->update($data);
        return $attendee;
    }

    public function delete($id)
    {
        $attendee = Attendee::findOrFail($id);
        return $attendee->delete();
    }

    public function paginateAndFilter(array $filters): LengthAwarePaginator {
        $query = Attendee::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['email'])) {
            $query->where('email', $filters['email']);
        }

        return $query->paginate($filters['per_page'] ?? 10);
    }
}
