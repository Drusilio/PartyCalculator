<?php

namespace App\Controller\UserController\Dto;

use Symfony\Component\Validator\Constraints\NotBlank;

class CreateUserDto
{
    #[NotBlank(allowNull: false)]
    private string $name;

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
}
