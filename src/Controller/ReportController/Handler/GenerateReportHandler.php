<?php

namespace App\Controller\ReportController\Handler;

use App\Controller\ReportController\Dto\GenerateReportDto;
use App\Controller\ReportController\Dto\ResponseGenerateReportDto;
use App\Entity\Event;
use App\Entity\Report;
use App\Entity\Transaction;
use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\ReportRepository;
use App\Repository\TransactionRepository;
use App\Service\DebtsExtractorService;

class GenerateReportHandler implements GenerateReportHandlerInterface
{
    public function __construct(private readonly ReportRepository $reportRepository,
                                private readonly EventRepository $eventRepository,
                                private readonly DebtsExtractorService $debtsExtractorService,
                                private readonly TransactionRepository $transactionRepository,
                                private readonly ResponseGenerateReportDto $responseGenerateReportDto){

    }

    public function handle(GenerateReportDto $dto): array
    {
        $report = new Report();
        $event = $this->eventRepository->getByUuid($dto->getEventUuid());

        $report->setDefaultTransactions(
               $this->generateDefaultTransactions($event)
        );
        $event->setIsCompleted(true);
        $this->debtsExtractorService->extractDebts($event->getExpenditureList());
        $report->setEvent($event);
        $this->reportRepository->save($report, true);

        return $this->responseGenerateReportDto->parseArrayFromReport($report);
    }

    /**
     * @return array<Transaction>
     */
    private function generateDefaultTransactions(Event $event): array
    {
        $debts = $this->debtsExtractorService->extractDebts($event->getExpenditureList());
        $n = $event->getUsers()->count();
        $usersArray = [];
        $i = 0;
        foreach ($event->getUsers() as $user){
            $usersArray[$i] = $user;
            $i++;
        }

        $matrix = array_fill(0, $n, array_fill(0, $n, 0));
        $matrix = $this->fillMatrix($usersArray, $debts, $matrix);

        return $this->makeTransactionsArray($matrix, $usersArray, $n);
    }

    private function userIndexInMatrix(User $user, array $usersArray) : int
    {
        return array_search($user, $usersArray);
    }

    private function fillMatrix(array $usersArray, array $debts, array $matrix) : array
    {
        foreach ($debts as $debt) {
            $b = max($this->userIndexInMatrix($debt->getUserTo(), $usersArray), $this->userIndexInMatrix($debt->getUserFrom(), $usersArray));
            $a = min($this->userIndexInMatrix($debt->getUserTo(), $usersArray), $this->userIndexInMatrix($debt->getUserFrom(), $usersArray));

            if($b == $this->userIndexInMatrix($debt->getUserFrom(), $usersArray)){
                $sign = -1;
            } else {
                $sign = 1;
            }

            $matrix[$b][$a] += $sign * $debt->getAmount();
        }

        return $matrix;
    }

    private function makeTransactionsArray(array $matrix, array $usersArray, int $n) : array
    {
        $transactionsArray = [];
        for ($i = 0; $i <= ($n-1); $i++) {
            for($j = 0; $j <= $i; $j++) {
                if ($matrix[$i][$j] === 0) {
                    continue;
                }

                if ($matrix[$i][$j] < 0) {
                    $debtor = $usersArray[$i];
                    $recipient = $usersArray[$j];
                } else {
                    $debtor = $usersArray[$j];
                    $recipient = $usersArray[$i];
                }

                $transaction = new Transaction($debtor, $recipient, abs($matrix[$i][$j]));
                $this->transactionRepository->save($transaction, false);
                $transactionsArray[] = $transaction;
            }
        }

        return $transactionsArray;
    }
}
