<?php

namespace App\Controller\EventController\Handler\CreateEventHandler;

use App\Controller\EventController\Dto\CreateEventDto;
use App\Controller\UserController\Dto\CreateUserDto;
use App\Entity\Event;
use App\Entity\User;
use App\Repository\EventRepository;
use Symfony\Component\Uid\Uuid;

class CreateEventHandler implements CreateEventHandlerInterface
{
    public function __construct(private readonly EventRepository $repository){

    }
    public function handle (CreateEventDto $createEventDto, User $user): Uuid {
        $event = new Event();
        $event->setName($createEventDto->getName());
        $event->addUser($user);
        $this->repository->save($event, true);

        return $event->getUuid();
    }
}
