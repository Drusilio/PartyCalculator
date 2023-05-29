<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\ValidationException;
use Exception;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidator;

class Validator implements ValidatorInterface
{
    public function __construct(private SymfonyValidator $validator)
    {
    }

    /** @throws Exception */
    public function validate(mixed $dataToValidate): void
    {
        $violationList = $this->validator->validate($dataToValidate);
        /** @var ConstraintViolation $error */
        foreach ($violationList as $error) {
            $errors[$error->getPropertyPath()][] = $error->getMessage();
        }

        if (!empty($errors)) {
            throw new ValidationException($errors, 400);
        }
    }
}
