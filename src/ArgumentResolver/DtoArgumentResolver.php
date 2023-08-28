<?php

namespace App\ArgumentResolver;

use App\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class DtoArgumentResolver implements ValueResolverInterface
{
    public function __construct(private readonly DefaultCommandFactory $defaultFactory, private readonly ValidatorInterface $validator)
    {
    }

    public function supports(ArgumentMetadata $argument): bool
    {
        return !empty($argument->getAttributesOfType(AttributeArgument::class));
    }

    public function resolve(Request $request, ArgumentMetadata $argumentMetadata): iterable
    {
        if (!$this->supports($argumentMetadata)) {
            return [];
        }

        $argumentAttributes = $argumentMetadata->getAttributesOfType(AttributeArgument::class);
        if (1 != count($argumentAttributes)) {
            throw new \Exception('Cannot be several attribute for one argument');
        }

        /** @phpstan-ignore-next-line */
        $argumentDto = $this->defaultFactory->create($request, $argumentMetadata->getType());

        $this->validator->validate($argumentDto);

        return [$argumentDto];
    }
}
