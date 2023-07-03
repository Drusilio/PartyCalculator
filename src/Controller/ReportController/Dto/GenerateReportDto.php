<?php

namespace App\Controller\ReportController\Dto;

use Symfony\Component\Uid\Uuid;

class GenerateReportDto
{
    private Uuid $eventUuid;

    public function getEventUuid(): Uuid
    {
        return $this->eventUuid;
    }

    public function setEventUuid(Uuid $eventUuid): void
    {
        $this->eventUuid = $eventUuid;
    }
}
