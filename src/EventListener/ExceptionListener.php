<?php

namespace App\EventListener;

use App\Exception\ValidationException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

#[AsEventListener(event: 'kernel.exception', method: 'onKernelException')]
class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ValidationException) {
            $response = new JsonResponse(['errors' => $exception->getErrors()], $exception->getCode());
            $event->setResponse($response);
        }

        if ($exception instanceof HttpException) {
            $response = new JsonResponse(['errors' => [$exception->getMessage()]], $exception->getStatusCode());
            $event->setResponse($response);
        }
    }
}
