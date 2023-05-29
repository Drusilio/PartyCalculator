<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Response\PaginatorResponse;
use App\Response\ResponseBag;
use App\Response\ResponseSerializerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[AsEventListener(event: KernelEvents::VIEW, method: 'onKernelResponse')]
class ResponseListener
{
    public function __construct(
        private readonly ResponseSerializerInterface $serializer,
        private readonly ResponseBag $responseBag
    ) {
    }

    /**
     * If there is exception "Malformed UTF-8 characters, possibly incorrectly encoded"
     *  and you select uuid from db by `getScalarResult`, change it on
     * `getArrayResult` or something else.
     */
    public function onKernelResponse(ViewEvent $event): void
    {
        $responseFromController = $event->getControllerResult();

        $response = match (true) {
            $responseFromController instanceof PaginatorResponse => $this->getJsonPaginatorResponse($responseFromController),
            default => $this->getJsonResponse($responseFromController),
        };

        $event->setResponse($response);
    }

    public function getResponseCode(): int
    {
        return $this->responseBag->getResponseCode();
    }

    public function getJsonResponse(mixed $responseFromController): JsonResponse
    {
        $responseData = ['result' => $responseFromController];

        if (!empty($this->responseBag->getNotifications())) {
            $responseData['notifications'] = $this->responseBag->getNotifications();
        }

        return new JsonResponse(
            $this->serializer->serialize(
                $responseData,
                [AbstractNormalizer::GROUPS => PaginatorResponse::ONLY_DEFAULT_GROUP]
            ),
            $this->getResponseCode(),
            json: true
        );
    }

    public function getJsonPaginatorResponse(PaginatorResponse $responseFromController): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->serialize(
                $responseFromController,
                [AbstractNormalizer::GROUPS => PaginatorResponse::ONLY_LIST_GROUP]
            ),
            $this->getResponseCode(),
            json: true
        );
    }
}
