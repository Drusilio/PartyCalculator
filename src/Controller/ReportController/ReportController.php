<?php

namespace App\Controller\ReportController;

use App\ArgumentResolver\AttributeArgument;
use App\Controller\ReportController\Dto\GenerateReportDto;
use App\Controller\ReportController\Handler\GenerateReportHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/report')]
class ReportController extends AbstractController
{
    #[Route('/generate', methods: [Request::METHOD_POST])]
    public function generateReport(#[AttributeArgument] GenerateReportDto $dto, GenerateReportHandlerInterface $handler): array
    {
        return $handler->handle($dto);
    }
}
