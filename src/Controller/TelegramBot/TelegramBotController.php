<?php

namespace App\Controller\TelegramBot;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update as UpdateObject;

#[Route('/bot')]
class TelegramBotController  extends AbstractController
{
    #[Route('/webhook', methods: [Request::METHOD_POST])]
    public function webhook()
    {
        $telegram = new Api('6342601130:AAG2aWe73GcHOlcWk-LWsBFVioGBgqiyxN4');
        $result = $telegram->getWebhookUpdates();

        $text = $result->getMessage();
        $text->
        $chat_id = $result["message"]["chat"]["id"];

        if($text == '/start') {
            $reply = "Hello World";
            $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
        }

        if($text == '/create_user') {
            $reply = "You are in!";
            $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
        }
    }

    private function commandTextDevider(UpdateObject $result)
    {
        /*$text = $result["message"]["text"];
        $offset = $result["message"]["entities"]["offset"];
        $length = $result["message"]["entities"]["length"];
        $botCommand = $result;
        $messagaText = ;
        return [$botCommand, $messagaText];*/
    }
}