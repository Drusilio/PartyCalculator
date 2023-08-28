<?php

namespace App\Controller\UserController\Handler\CreateUserHandler;

use App\Controller\UserController\Dto\CreateUserDto;
use Symfony\Component\Uid\Uuid;

interface CreateUserHandlerInterface
{
    public function handle(CreateUserDto $dto): Uuid;
}
