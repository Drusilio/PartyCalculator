<?php

declare(strict_types=1);

namespace App\Request;

use App\Request\RequestDeserializerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class RequestDeserializer implements RequestDeserializerInterface
{
    public function __construct(private SerializerInterface&DenormalizerInterface $serializer)
    {
    }

    public function deserialize(Request $request, string $type): mixed
    {
        try {
            $dto = match ($request->getMethod()) {
                Request::METHOD_POST, Request::METHOD_PUT, Request::METHOD_PATCH => $this->serializer->deserialize($request->getContent(), $type, 'json'),
                Request::METHOD_GET, Request::METHOD_DELETE => $this->serializer->denormalize($request->query->all(), $type, 'array', [
                    AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
                ]),
                default => throw new Exception(sprintf('For "%s" method not implemented deserializing', $request->getMethod())),
            };
        } catch (Throwable $exception) {
            throw new HttpException(400, sprintf('Error while deserializing data (%s)', $exception->getMessage()));
        }
        return $dto;
    }
}
