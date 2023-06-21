<?php

namespace App\Controller\Expenditure\Handler\SubscribeOnExpenditureHandler;

use App\Controller\Expenditure\Dto\SubscribeOnExpenditureDto;
use App\Entity\User;

interface SubscribeOnExpenditureHandlerInterface
{
    public function handle(SubscribeOnExpenditureDto $dto, User $user);
}
