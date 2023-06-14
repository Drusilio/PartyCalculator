<?php

namespace App\Controller\EventController;

use App\ArgumentResolver\AttributeArgument;
use App\Controller\EventController\Dto\AddExpenditureToEventDto;
use App\Controller\EventController\Dto\AddUserToEventDto;
use App\Controller\EventController\Dto\CreateEventDto;
use App\Controller\EventController\Handler\AddExpenditureToEventHandler\AddExpenditureToEventHandlerInterface;
use App\Controller\EventController\Handler\AddUserToEventHandler\AddUserToEventHandlerInterface;
use App\Controller\EventController\Handler\CreateEventHandler\CreateEventHandlerInterface;
use App\Controller\EventController\Handler\GetEventsListHandler\GetEventsListHandlerInterface;
use App\Service\UserExtractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/create', methods: [Request::METHOD_POST])]
    public function createEvent(#[AttributeArgument] CreateEventDto $createEventDto, CreateEventHandlerInterface $createEventHandler, UserExtractor $userExtractor): Uuid {
        $user = $userExtractor->extract();

        return $createEventHandler->handle($createEventDto, $user);
    }

    #[Route('/add-user', methods: [Request::METHOD_POST])]
    public function addUser(#[AttributeArgument] AddUserToEventDto $addUserToEventDto, AddUserToEventHandlerInterface $addUserToEventHandler, UserExtractor $userExtractor): Uuid {
        $user = $userExtractor->extract();

        return $addUserToEventHandler->handle($addUserToEventDto, $user);
    }

    #[Route('/add-expenditure', methods: [Request::METHOD_POST])]
    public function addExpenditure(#[AttributeArgument] AddExpenditureToEventDto $dto, AddExpenditureToEventHandlerInterface $handler, UserExtractor $userExtractor): Uuid{
        $user = $userExtractor->extract();

        return $handler->handle($dto, $user);
    }

    #[Route('/get-events-list', methods: [Request::METHOD_GET])]
    public function getEventsList(GetEventsListHandlerInterface $eventsListHandler): array
    {
        return $eventsListHandler->handle();
    }
}
