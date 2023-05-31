<?php

namespace App\Controller\EventController\Handler\AddUserToEventHandler;

use App\Controller\EventController\Dto\AddUserToEventDto;
use App\Entity\User;
use App\Repository\EventRepository;
use Exception;
use Symfony\Component\Uid\Uuid;

class AddUserToEventHandler implements AddUserToEventHandlerInterface
{
    public function __construct(private readonly EventRepository $eventRepository){

    }

    public function handle(AddUserToEventDto $addUserToEventDto, User $user): Uuid
    {
        $event = $this->eventRepository->findOneBy(['uuid'=>$addUserToEventDto->getUuid()]);
        if ($event === null)
        {
            throw new Exception('There is no such Event');
        }
        $event->addUser($user);
        $this->eventRepository->save($event,  true);

        return $event->getUuid();
    }
}
