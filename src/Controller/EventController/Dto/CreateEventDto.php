<?php

namespace App\Controller\EventController\Dto;

use Symfony\Component\Validator\Constraints\NotBlank;

class CreateEventDto
{
    #[NotBlank(allowNull: false)]
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
