<?php

namespace App\Controller\EventController\Handler\ShowEventHandler;

use App\Controller\EventController\Dto\ShowEventDto;
use App\Entity\User;

interface ShowEventHandlerInterface
{
    public function handle(ShowEventDto $dto, User $user): array;
}
