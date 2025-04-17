<?php
namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepository;

class EventService
{
    protected $eventRepo;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    public function getAllEvents()
    {
        return $this->eventRepo->getAll();
    }

    public function getEvent($id)
    {
        return $this->eventRepo->findById($id);
    }

    public function createEvent(array $data)
    {
        return $this->eventRepo->create($data);
    }

    public function updateEvent(Event $event, array $data)
    {
        return $this->eventRepo->update($event, $data);
    }

    public function deleteEvent(Event $event)
    {
        return $this->eventRepo->delete($event);
    }
}
