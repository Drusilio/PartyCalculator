<?php

namespace App\Controller\ReportController\Handler;

use App\Controller\ReportController\Dto\GenerateReportDto;

interface GenerateReportHandlerInterface
{
    public function handle(GenerateReportDto $dto): array;
}
