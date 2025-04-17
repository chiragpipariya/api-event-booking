<?php 
namespace App\Repositories;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{
    public function all()
    {
        return Event::all();
    }

    public function find($id)
    {
        return Event::findOrFail($id);
    }

    public function create(array $data)
    {
        return Event::create($data);
    }

    public function update($id, array $data)
    {
        $event = Event::findOrFail($id);
        $event->update($data);
        return $event;
    }

    public function delete($id)
    { 
        $event = Event::findOrFail($id);
        return $event->delete();
    }
    public function paginateAndFilter(array $filters): LengthAwarePaginator {
        $query = Event::query();
 
        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (!empty($filters['description'])) {
            $query->where('description', $filters['description']);
        }

        return $query->paginate($filters['per_page'] ?? 10);
    }
}
