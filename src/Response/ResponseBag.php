<?php

declare(strict_types=1);

namespace App\Response;

use Symfony\Component\HttpFoundation\Response;

class ResponseBag
{
    /** @var string[] */
    private array $notifications = [];

    private int $code = Response::HTTP_OK;

    public function __construct()
    {
    }

    public function getResponseCode(): int
    {
        return $this->code;
    }

    public function getNotifications(): array
    {
        return $this->notifications;
    }

    public function addNotification(string $notification): void
    {
        $this->notifications[] = $notification;
    }

    public function setStatusCode(int $code): void
    {
        $this->code = $code;
    }
}
