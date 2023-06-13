<?php

namespace App\Controller\EventController\Handler\AddExpenditureToEventHandler;

use App\Controller\EventController\Dto\AddExpenditureToEventDto;
use App\Entity\Expenditure;
use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\ExpenditureRepository;
use Symfony\Component\Uid\Uuid;

class AddExpenditureToEventHandler implements AddExpenditureToEventHandlerInterface
{
    public function __construct(private readonly EventRepository $eventRepository){

    }

    public function handle(AddExpenditureToEventDto $addExpenditureToEventDto, User $user): Uuid
    {
        $event = $this->eventRepository->findOneBy(['uuid' => $addExpenditureToEventDto->getEventUuid()]);
        $expenditure = new Expenditure();
        $expenditure->setName($addExpenditureToEventDto->getExpenditureName());
        $expenditure->setAmountSpent($addExpenditureToEventDto->getAmountSpent());
        $expenditure->addSubscribers($user);
        $expenditure->setEvent($event);
        $expenditure->setExpensist($user);
        $event->addExpenditureList($expenditure);
        $this->eventRepository->save($event, true);

        return $event->getUuid();
    }
}
