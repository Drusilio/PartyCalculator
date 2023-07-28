<?php

namespace App\TelegramBotCommand;

use App\Controller\EventController\Dto\AddExpenditureToEventDto;
use App\Controller\EventController\Handler\AddExpenditureToEventHandler\AddExpenditureToEventHandlerInterface;
use App\Repository\EventRepository;
use App\Repository\ExpenditureRepository;
use App\Repository\UserRepository;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update as UpdateObject;

class AddExpenditureToEventCommand implements Command
{
    public function __construct(private readonly EventRepository $eventRepository,
                                private readonly UserRepository $userRepository,
                                private readonly AddExpenditureToEventHandlerInterface $handler)
    {

    }

    public function execute(Api $telegram, UpdateObject $result, string $botCommand, string $messageText)
    {
        $chat_id = $result["message"]["chat"]["id"];
        if (empty($messageText)) {
            $reply = "Please enter information in next format: 'eventName,expenditureName,amountSpent'";
        } else {
            $user_id = $result["message"]["from"]["id"];
            $user = $this->userRepository->findOneBy(["telegramId" => $user_id]);

            list($eventName, $expenditureName, $amountSpent) = $parametersArray = $this->fromStringToArray($messageText);
            $event = $this->eventRepository->findOneBy(["name" => $eventName]);
            if ($event === null) {
                $reply = "There is no such event";
            } else {
                $dto = new AddExpenditureToEventDto();
                $dto->setEventUuid($event->getUuid());
                $dto->setExpenditureName($expenditureName);
                $dto->setAmountSpent($amountSpent);

                $this->handler->handle($dto, $user);

                $reply = "Expenditure successfully created";
            }
        }
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
    }

    public function support(string $commandName): bool
    {
        return "/add_expenditure_to_event" === $commandName;
    }

    private function fromStringToArray(string $messageText):array
    {
        return explode(",", $messageText);
    }
}