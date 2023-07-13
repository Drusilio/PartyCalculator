<?php

namespace App\Controller\TelegramBot;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Telegram\Bot\Api;

#[Route('/bot')]
class TelegramBotController  extends AbstractController
{
    #[Route('/webhook', methods: [Request::METHOD_POST])]
    public function getSmth()
    {
        /*$telegram = new Api('6342601130:AAG2aWe73GcHOlcWk-LWsBFVioGBgqiyxN4');
        $result = $telegram->getWebhookUpdates();

        $text = $result["message"]["text"];
        $chat_id = $result["message"]["chat"]["id"];

        if($text == '/start') {
            $reply = "Hello World";
            $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
        }*/
    }
}