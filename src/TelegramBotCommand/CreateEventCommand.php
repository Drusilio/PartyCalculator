<?php

namespace App\TelegramBotCommand;

use App\Controller\EventController\Dto\CreateEventDto;
use App\Controller\EventController\Handler\CreateEventHandler\CreateEventHandlerInterface;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update as UpdateObject;

class CreateEventCommand implements Command
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly CreateEventHandlerInterface $createEventHandler
    )
    {

    }

    public function execute(Api $telegram, UpdateObject $result, string $botCommand, string $messageText)
    {
        $chat_id = $result["message"]["chat"]["id"];
        $user_id = $result["message"]["from"]["id"];

        $user = $this->userRepository->findOneBy(['telegramId' => $user_id]);
        $dto = new CreateEventDto();
        $dto->setName($messageText);

        $this->createEventHandler->handle($dto, $user);

        $reply = "Event successfully created";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
    }

    public function support(string $commandName): bool
    {
        return "/create_event" === $commandName;
    }
}