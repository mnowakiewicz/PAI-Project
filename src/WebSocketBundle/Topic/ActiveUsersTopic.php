<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 06.01.19
 * Time: 16:39
 */

namespace WebSocketBundle\Topic;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Gos\Bundle\WebSocketBundle\Client\ClientManipulatorInterface;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;


/**
 * Class NotificationTopic
 * @package WebSocketBundle\Topic
 */
class ActiveUsersTopic implements TopicInterface
{
    /**
     * @var ArrayCollection
     */
    private $activeUsers;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ClientManipulatorInterface
     */
    protected $clientManipulator;

    /**
     * ActiveUsersTopic constructor.
     * @param EntityManagerInterface $em
     * @param ClientManipulatorInterface $clientManipulator
     */
    public function __construct(EntityManagerInterface $em, ClientManipulatorInterface $clientManipulator)
    {
        $this->activeUsers = new ArrayCollection();
        $this->em = $em;
        $this->clientManipulator = $clientManipulator;
    }

    /**
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast(['msg' => $this->clientManipulator->getClient($connection)]);
    }

    /**
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     */
    public function onUnSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast(['msg' => $connection->resourceId . " has left " . $topic->getId()]);
    }

    /**
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     * @param $event
     * @param  array $exclude
     * @param  array $eligible
     */
    public function onPublish(ConnectionInterface $connection, Topic $topic, WampRequest $request, $event, array $exclude, array $eligible)
    {
        $topic->broadcast([
            'msg' => $event
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'active_users.topic';
    }
}