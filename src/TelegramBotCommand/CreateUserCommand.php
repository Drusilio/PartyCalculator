<?php

namespace App\TelegramBotCommand;

use App\Controller\UserController\Dto\CreateUserDto;
use App\Controller\UserController\Handler\CreateUserHandler\CreateUserHandlerInterface;
use Telegram\Bot\Objects\Update as UpdateObject;
use Telegram\Bot\Api;

class CreateUserCommand implements Command
{
    public function __construct(
        private readonly CreateUserHandlerInterface $createUserHandler
    )
    {

    }

    public function execute(Api $telegram, UpdateObject $result, string $botCommand, string $messageText)
    {
        $chat_id = $result["message"]["chat"]["id"];
        $name = $result["message"]["from"]["username"];
        $user_id = $result["message"]["from"]["id"];

        $dto = new CreateUserDto();
        $dto->setName($name);
        $dto->setPaymentMethods($messageText);
        $dto->setTelegramId($user_id);
        $this->createUserHandler->handle($dto);

        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "You are in!"]);

        $reply = "You are in!";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
    }

    public function support(string $commandName) : bool
    {
        return "/create_user" === $commandName;
    }
}