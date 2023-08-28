<?php

namespace App\Controller\EventController\Dto;

use Symfony\Component\Uid\Uuid;

class AddExpenditureToEventDto
{
    private Uuid $eventUuid;

    private string $expenditureName;

    private float $amountSpent;

    public function getEventUuid(): Uuid
    {
        return $this->eventUuid;
    }

    public function setEventUuid(Uuid $eventUuid): void
    {
        $this->eventUuid = $eventUuid;
    }

    public function getExpenditureName(): string
    {
        return $this->expenditureName;
    }

    public function setExpenditureName(string $expenditureName): void
    {
        $this->expenditureName = $expenditureName;
    }

    public function getAmountSpent(): float
    {
        return $this->amountSpent;
    }

    public function setAmountSpent(float $amountSpent): void
    {
        $this->amountSpent = $amountSpent;
    }
}
