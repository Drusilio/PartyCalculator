<?php

namespace App\Controller\UserController;

use App\ArgumentResolver\AttributeArgument;
use App\Controller\UserController\Dto\CreateUserDto;
use App\Controller\UserController\Handler\CreateUserHandler\CreateUserHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/create', methods: [Request::METHOD_POST])]
    public function createUser(#[AttributeArgument] CreateUserDto $createUserDto, CreateUserHandlerInterface $createUserHandler): Uuid
    {
        return $createUserHandler->handle($createUserDto);
    }
}
