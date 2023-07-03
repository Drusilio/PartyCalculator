<?php

namespace App\Controller\ReportController\Handler;

use App\Controller\ReportController\Dto\GenerateReportDto;
use App\Entity\Report;

interface GenerateReportHandlerInterface
{
    public function handle(GenerateReportDto $dto): array;
}
