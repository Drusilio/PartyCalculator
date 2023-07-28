<?php

namespace App\TelegramBotCommand;

use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update as UpdateObject;

interface Command
{
    public function execute(Api $telegram, UpdateObject $result, string $botCommand, string $messageText);

    public function support(string $commandName) : bool;
}