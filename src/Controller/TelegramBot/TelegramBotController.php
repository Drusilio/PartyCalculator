<?php

namespace App\Controller\TelegramBot;

use App\Controller\UserController\Dto\CreateUserDto;
use App\Controller\UserController\Handler\CreateUserHandler\CreateUserHandlerInterface;
use App\TelegramBotCommand\CommandFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update as UpdateObject;

#[Route('/bot')]
class TelegramBotController  extends AbstractController
{
    public function __construct(private readonly CommandFactory $commandFactory)
        {

        }

    #[Route('/webhook', methods: [Request::METHOD_POST])]
    public function webhook(
        string $telegramApiKey
    )
    {
        $telegram = new Api($telegramApiKey);
        $result = $telegram->getWebhookUpdates();

        list($botCommand, $messageText) = $this->commandTextDevider($result);

        $command = $this->commandFactory->createCommand($botCommand);
        $command->execute($telegram, $result, $botCommand, $messageText);
    }

    private function commandTextDevider(UpdateObject $result)
    {
        $text = $result["message"]["text"];
        $offset = $result["message"]["entities"][0]["offset"];
        $commandLength = $result["message"]["entities"][0]["length"];
        $botCommand = substr($text, $offset, $commandLength);
        $messageText = substr($text, $commandLength + 1);

        return [$botCommand, $messageText];
    }
}
