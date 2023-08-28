<?php

namespace App\Controller\EventController\Handler\CreateEventHandler;

use App\Controller\EventController\Dto\CreateEventDto;
use App\Entity\User;
use Symfony\Component\Uid\Uuid;

interface CreateEventHandlerInterface
{
    public function handle(CreateEventDto $createEventDto, User $user): Uuid;
}
