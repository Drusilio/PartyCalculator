<?php

namespace App\Service\Dto;

use App\Entity\User;

class Debt
{
    private User $userFrom;

    private User $userTo;

    private float $amount;

    public function getUserFrom(): User
    {
        return $this->userFrom;
    }

    public function setUserFrom(User $userFrom): void
    {
        $this->userFrom = $userFrom;
    }

    public function getUserTo(): User
    {
        return $this->userTo;
    }

    public function setUserTo(User $userTo): void
    {
        $this->userTo = $userTo;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }
}
