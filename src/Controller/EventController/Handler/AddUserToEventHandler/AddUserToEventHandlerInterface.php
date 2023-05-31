<?php

namespace App\Controller\EventController\Handler\AddUserToEventHandler;

use App\Controller\EventController\Dto\AddUserToEventDto;
use App\Entity\User;
use Symfony\Component\Uid\Uuid;

interface AddUserToEventHandlerInterface
{
    public function handle(AddUserToEventDto $addUserToEventDto, User $user): Uuid;
}
