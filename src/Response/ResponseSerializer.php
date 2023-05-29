<?php

declare(strict_types=1);

namespace App\Response;

use Symfony\Component\Serializer\SerializerInterface;

class ResponseSerializer implements ResponseSerializerInterface
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function serialize(mixed $data, array $context = []): string
    {
        return $this->serializer->serialize($data, 'json', $context);
    }
}
