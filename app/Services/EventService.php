<?php
namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
class EventService
{
    protected $eventRepo;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    public function getAllEvents()
    {
        return $this->eventRepo->all();
    }

    public function getPaginated(array $filters): LengthAwarePaginator {
        return $this->eventRepo->paginateAndFilter($filters);
    }

    public function find($id)
    {
        return $this->eventRepo->find($id);
    }

    public function create(array $data)
    {
        return $this->eventRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->eventRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->eventRepo->delete($id);
    }
}
