<?php

namespace App\Service;

use App\Entity\Expenditure;
use App\Service\Dto\Debt;

class DebtsExtractorService
{
    /**
     * @return array<Debt>
     */
    public function extractDebts(iterable $expenditures): array
    {
        $eventDebts = [];

        foreach ($expenditures as $expenditure) {
            $eventDebts = array_merge($eventDebts, $this->extractDebtsFromExpenditure($expenditure));
        }

        return $eventDebts;
    }

    /**
     * @return array<Debt>
     */
    private function extractDebtsFromExpenditure(Expenditure $expenditure): array
    {
        $expenditureDebts = [];

        $subscribersCount = $expenditure->getSubscribers()->count();
        $averageSum = $expenditure->getAmountSpent() / $subscribersCount;

        foreach ($expenditure->getSubscribers() as $subscriber) {
            if ($subscriber->getUuid() != $expenditure->getExpensist()->getUuid()) {
                $debt = new Debt();

                $debt->setAmount($averageSum);
                $debt->setUserFrom($subscriber);
                $debt->setUserTo($expenditure->getExpensist());

                $expenditureDebts[] = $debt;
            }
        }

        return $expenditureDebts;
    }
}
