<?php

namespace App\Controller\EventController\Handler\ShowEventHandler;

use App\Controller\EventController\Dto\ShowEventDto;
use App\Entity\Event;
use App\Entity\User;
use App\Repository\EventRepository;

class ShowEventHandler implements ShowEventHandlerInterface
{
    public function __construct(private readonly EventRepository $repository)
    {
    }

    public function handle(ShowEventDto $dto, User $user): array{
        $event = $this->repository->findOneBy(['uuid' => $dto->getUuid()]);
        if ($event->getIsCompleted()) {
            return $this->showCompletedEvent($event, $user);
        } else {
            return $this->showUncompletedEvent($event, $user);
        }
    }

    private function showUncompletedEvent(Event $event, User $user): array{
        $users = $event->getUsers();
        $subscriptionStatus = false;
        $userUuid = $user->getUuid();
        foreach ($users as $value) {
            if ($value->getUuid() == $userUuid) {
                $subscriptionStatus = true;
            }
        }
        return [
            'Uuid' => $event->getUuid(),
            'Name' => $event->getName(),
            'Subscription status' => $subscriptionStatus
        ];
    }

    private function showCompletedEvent(Event $event, User $user): array{
        $report = $event->getEventReport();
        return [
            'default transactions' => $report->getDefaultTransactions(),
            '$optimal transactions' => $report->getOptimalTransactions()
        ];
    }
}
