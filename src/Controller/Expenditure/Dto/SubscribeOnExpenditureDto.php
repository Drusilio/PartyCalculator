<?php

namespace App\Controller\Expenditure\Dto;

use Symfony\Component\Uid\Uuid;

class SubscribeOnExpenditureDto
{
    private Uuid $expenditureUuid;

    private Uuid $eventUuid;

    public function getExpenditureUuid(): Uuid
    {
        return $this->expenditureUuid;
    }

    public function setExpenditureUuid(Uuid $expenditureUuid): void
    {
        $this->expenditureUuid = $expenditureUuid;
    }

    public function getEventUuid(): Uuid
    {
        return $this->eventUuid;
    }

    public function setEventUuid(Uuid $eventUuid): void
    {
        $this->eventUuid = $eventUuid;
    }
}
