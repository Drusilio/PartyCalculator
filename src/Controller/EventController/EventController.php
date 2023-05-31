<?php

namespace App\Controller\EventController;

use App\ArgumentResolver\AttributeArgument;
use App\Controller\EventController\Dto\AddUserToEventDto;
use App\Controller\EventController\Dto\CreateEventDto;
use App\Controller\EventController\Handler\AddUserToEventHandler\AddUserToEventHandlerInterface;
use App\Controller\EventController\Handler\CreateEventHandler\CreateEventHandlerInterface;
use App\Service\UserExtractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/create')]
    public function createEvent(#[AttributeArgument] CreateEventDto $createEventDto, CreateEventHandlerInterface $createEventHandler, UserExtractor $userExtractor) {
        $user = $userExtractor->extract();

        return $createEventHandler->handle($createEventDto, $user);
    }

    #[Route('/add-user')]
    public function addUser(#[AttributeArgument] AddUserToEventDto $addUserToEventDto, AddUserToEventHandlerInterface $addUserToEventHandler, UserExtractor $userExtractor) {
        $user = $userExtractor->extract();

        return $addUserToEventHandler->handle($addUserToEventDto, $user);
    }
}
