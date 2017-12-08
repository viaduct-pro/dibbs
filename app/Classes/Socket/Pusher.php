<?php

namespace App\Classes\Socket;


use App\Classes\Socket\Base\BasePusher;

use ZMQContext;

class Pusher extends BasePusher
{
    static function sendDataToServer(array $data)
    {
        $context = new ZMQContext();
        $soket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my_pusher');

        $soket->connect('tcp://127.0.0.1:5555');

        $data = json_encode($data);
        $soket->send();
    }

    public function broadcast($jsonDataToSend)
    {
        $aDataToSend = json_decode($jsonDataToSend, true);

        $subscribedTopics = $this->getSubscribedTopics();

        if (isset($subscribedTopics[ $aDataToSend['topic_id']]))
        {
            $topic = $subscribedTopics[$aDataToSend['topic_id']];
            $topic->broadcast($aDataToSend);
        }
    }
}