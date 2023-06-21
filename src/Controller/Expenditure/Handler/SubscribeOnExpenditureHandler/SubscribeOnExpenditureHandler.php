<?php

namespace App\Controller\Expenditure\Handler\SubscribeOnExpenditureHandler;

use App\Controller\Expenditure\Dto\SubscribeOnExpenditureDto;
use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\ExpenditureRepository;
use Exception;

class SubscribeOnExpenditureHandler implements SubscribeOnExpenditureHandlerInterface
{
    public function __construct(private readonly ExpenditureRepository $expenditureRepository, private readonly EventRepository $eventRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function handle(SubscribeOnExpenditureDto $dto, User $user){
        $event = $this->eventRepository->findOneBy(['uuid'=>$dto->getEventUuid()]);
        $expenditure = $this->expenditureRepository->findOneBy(['uuid'=>$dto->getExpenditureUuid()]);
        if (!$event->isUserSubscribed($user)){
            throw new Exception('You do not subscribed on event for this expenditure');
        }
            $expenditure->addSubscriber($user);
            $this->expenditureRepository->save($expenditure, true);
    }
}
