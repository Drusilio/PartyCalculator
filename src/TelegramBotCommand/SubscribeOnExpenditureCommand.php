<?php

namespace App\TelegramBotCommand;

use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update as UpdateObject;

class SubscribeOnExpenditureCommand implements Command
{

    public function execute(Api $telegram, UpdateObject $result, string $botCommand, string $messageText)
    {
        // TODO: Implement execute() method.
    }

    public function support(string $commandName): bool
    {
        return "/subscribe_on_expenditure" === $commandName;
    }
}