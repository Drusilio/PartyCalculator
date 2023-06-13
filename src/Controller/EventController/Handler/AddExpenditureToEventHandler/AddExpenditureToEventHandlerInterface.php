<?php

namespace App\Controller\EventController\Handler\AddExpenditureToEventHandler;

use App\Controller\EventController\Dto\AddExpenditureToEventDto;
use App\Entity\User;
use Symfony\Component\Uid\Uuid;

interface AddExpenditureToEventHandlerInterface
{
    public function handle(AddExpenditureToEventDto $addExpenditureToEventDto, User $user):Uuid;
}