<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Stringable;
use Symfony\Component\HttpFoundation\Response;

class ValidationException extends Exception
{
    /** @param array<string, array<int, Stringable|string>> $errors */
    public function __construct(private readonly array $errors, int $code = Response::HTTP_BAD_REQUEST)
    {
        parent::__construct(code: $code);
    }

    /**
     * @return array<string, array<int, Stringable|string>>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
