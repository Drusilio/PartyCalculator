<?php

namespace App\Controller\UserController\Dto;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateUserDto
{
    #[NotBlank(allowNull: false)]
    private string $name;

    #[NotBlank(allowNull: false)]
    private int $telegramId;

    private string $paymentMethods;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPaymentMethods(): string
    {
        return $this->paymentMethods;
    }

    public function setPaymentMethods(string $paymentMethods): void
    {
        $this->paymentMethods = $paymentMethods;
    }

    public function getTelegramId(): int
    {
        return $this->telegramId;
    }

    public function setTelegramId(int $telegramId): void
    {
        $this->telegramId = $telegramId;
    }
}
