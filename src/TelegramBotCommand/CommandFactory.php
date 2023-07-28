<?php

namespace App\TelegramBotCommand;

class CommandFactory
{
    /**
     * @param iterable<Command> $handlers
     */
    public function __construct(
        private readonly iterable $handlers
    )
    {
    }

    public function createCommand(string $botCommand): Command
    {
        foreach ($this->handlers as $handler) {
            if ($handler->support($botCommand)) {
                return $handler;
            }
        }

        throw new \Exception('This command not implemented yet');
    }
}