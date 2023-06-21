<?php

namespace App\Controller\EventController\Dto;

use Symfony\Component\Uid\Uuid;

class ShowEventDto
{
    public Uuid $uuid;

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): void
    {
        $this->uuid = $uuid;
    }
}
