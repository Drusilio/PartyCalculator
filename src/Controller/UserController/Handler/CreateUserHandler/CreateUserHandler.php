<?php

namespace App\Controller\UserController\Handler\CreateUserHandler;

use App\Controller\UserController\Dto\CreateUserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Uid\Uuid;

class CreateUserHandler implements CreateUserHandlerInterface
{
    public function __construct(private readonly UserRepository $repository){

    }

    public function handle(CreateUserDto $dto):Uuid
    {
        $user = new User();
        $user->setName($dto->getName());
        $user->setPaymentMethods($dto->getPaymentMethods());

        $this->repository->save($user, true);

        return $user->getUuid();
    }
}