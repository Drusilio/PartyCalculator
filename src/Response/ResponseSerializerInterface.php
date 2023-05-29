<?php

declare(strict_types=1);

namespace App\Response;

interface ResponseSerializerInterface
{
    public function serialize(mixed $data, array $context = []): string;
}
