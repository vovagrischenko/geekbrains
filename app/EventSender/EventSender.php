<?php
namespace App\EventSender;

use App\Queue\Queueable;
use App\Queue\Queue;
use App\TelegramApi;

class EventSender implements Queueable
{


    public function __construct(TelegramApi $telegram, Queue $queue){

    }

    public function sendMessage(string $receiver, string $message)
    {

        $this->Telegram->toQueue($receiver, $message);
    }

    public function hanlde(){
            $this->Telegram->sendMessage($this->$receiver, $this->$message);
    }

    public function toQueue(...$args){
        $this->$receiver = $args[0];
        $this->$message = $args[1];
        $this->queue->sendMessage(serialize($this));
    }
}