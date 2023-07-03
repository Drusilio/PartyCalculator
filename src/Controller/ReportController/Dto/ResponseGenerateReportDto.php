<?php

namespace App\Controller\ReportController\Dto;

use App\Entity\Report;

class ResponseGenerateReportDto
{
    public function parseArrayFromReport(Report $report): array
    {
        $array = [];
        $transactions = $report->getDefaultTransactions();

        foreach ($transactions as $transaction) {
            $array[] = ['debtor' => $transaction->getDebtor()->getName(),
                        'recipient' => $transaction->getRecipient()->getName(),
                        'amount' => $transaction->getAmountSpent()];
        }

        return $array;
    }
}
