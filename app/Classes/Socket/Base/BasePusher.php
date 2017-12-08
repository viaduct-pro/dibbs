<?php
namespace App\Classes\Socket\Base;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class BasePusher implements WampServerInterface
{
    protected $subscribedTopics = [];

    public function getSubscribedTopics()
    {
        return $this->subscribedTopics;
    }

    public function addSubscribedTopic($topic)
    {
        $this->subscribedTopics[$topic->getId()] = $topic;
    }

    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->addSubscribedTopic($topic);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {
        // TODO: Implement onUnSubscribe() method.
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        $conn->callError($id, $topic, 'Not allowed!')->close();
    }

    public function onClose(ConnectionInterface $conn)
    {
        // TODO: Implement onClose() method.
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        $conn->close();
        // TODO: Implement onPublish() method.
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo "New connection! ({$conn->resourceId})\n";

    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error! ({$e->getMessage()})\n";
        $conn->close();
    }
}