<?php

declare(strict_types=1);

namespace App\Validator;

use Exception;

interface ValidatorInterface
{
    /** @throws Exception */
    public function validate(mixed $dataToValidate): void;
}
