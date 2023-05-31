<?php

namespace App\Controller\EventController\Dto;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddUserToEventDto
{
    #[NotBlank(allowNull: false)]
    private Uuid $uuid;

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): void
    {
        $this->uuid = $uuid;
    }
}
