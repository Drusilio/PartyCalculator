<?php

namespace App\Controller\ExpenditureController\Handler\SubscribeOnExpenditureHandler;

use App\Controller\ExpenditureController\Dto\SubscribeOnExpenditureDto;
use App\Entity\User;

interface SubscribeOnExpenditureHandlerInterface
{
    public function handle(SubscribeOnExpenditureDto $dto, User $user);
}
