<?php

namespace App\Controller\ExpenditureController;

use App\ArgumentResolver\AttributeArgument;
use App\Controller\ExpenditureController\Dto\SubscribeOnExpenditureDto;
use App\Controller\ExpenditureController\Handler\SubscribeOnExpenditureHandler\SubscribeOnExpenditureHandlerInterface;
use App\Service\UserExtractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/expenditure')]
class ExpenditureController extends AbstractController
{
    #[Route('/subscribe-on-expenditure', methods: [Request::METHOD_POST])]
    public function subscribeOnExpenditure(#[AttributeArgument] SubscribeOnExpenditureDto $dto, SubscribeOnExpenditureHandlerInterface $handler, UserExtractor $userExtractor)
    {
        $user = $userExtractor->extract();
        $handler->handle($dto, $user);
    }
}
