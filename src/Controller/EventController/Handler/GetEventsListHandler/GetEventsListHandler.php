<?php

namespace App\Controller\EventController\Handler\GetEventsListHandler;

use App\Repository\EventRepository;

class GetEventsListHandler implements GetEventsListHandlerInterface
{
    public function __construct(private readonly EventRepository $eventRepository)
    {
    }

    public function handle(): array
    {
        return $this->eventRepository->getEventsList();
    }
}
