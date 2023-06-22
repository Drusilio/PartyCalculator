<?php

namespace App\Controller\EventController\Handler\ShowEventHandler;

use App\Controller\EventController\Dto\ShowEventDto;
use App\Entity\Event;
use App\Entity\Transaction;
use App\Entity\User;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\Collection;

class ShowEventHandler implements ShowEventHandlerInterface
{
    public function __construct(private readonly EventRepository $repository)
    {
    }

    public function handle(ShowEventDto $dto, User $user): array{
        $event = $this->repository->getByUuid($dto->getUuid());
        if ($event->getIsCompleted()) {
            return $this->showCompletedEvent($event, $user);
        } else {
            return $this->showUncompletedEvent($event, $user);
        }
    }

    private function showUncompletedEvent(Event $event, User $user): array{
        return [
            'uuid' => $event->getUuid(),
            'name' => $event->getName(),
            'subscriptionStatus' => $event->isUserSubscribed($user)
        ];
    }

    private function showCompletedEvent(Event $event, User $user): array
    {
        $report = $event->getEventReport();

        return [
            'defaultTransactions' => $this->convertTransactionCollectionToViewForm($report->getDefaultTransactions()),
            'optimalTransactions' => $this->convertTransactionCollectionToViewForm($report->getOptimalTransactions()),
        ];
    }

    /**
     * @param Collection<Transaction> $transactions
     */
    private function convertTransactionCollectionToViewForm(Collection $transactions): array
    {
        $response = [];
        foreach ($transactions as $transaction) {
            $response[] = [
                'uuid' => $transaction->getUuid(),
                'isSent' => $transaction->getIsSent(),
                'amount' => $transaction->getAmountSpent(),
                'debtor' => [
                    'uuid' => $transaction->getDebtor()->getUuid(),
                    'name' => $transaction->getDebtor()->getName(),
                ],
                'recipient' => [
                    'uuid' => $transaction->getRecipient()->getUuid(),
                    'name' => $transaction->getRecipient()->getName(),
                ],
            ];
        }

        return $response;
    }
}
