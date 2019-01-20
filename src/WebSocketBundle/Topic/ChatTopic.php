<?php
/**
 * Created by Maciej Nowakiewicz
 * Date: 20.01.19
 * Time: 17:53
 */


namespace WebSocketBundle\Topic;


use Doctrine\ORM\EntityManagerInterface;
use Gos\Bundle\WebSocketBundle\Client\ClientManipulatorInterface;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use OperatorBundle\Entity\Operator;
use OperatorBundle\Repository\OperatorRepository;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Ratchet\Wamp\WampConnection;
use Symfony\Component\Validator\Constraints\Date;
use WebSocketBundle\Entity\Message;
use WebSocketBundle\Repository\MessageRepository;

class ChatTopic implements TopicInterface
{

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var ClientManipulatorInterface
     */
    protected $clientManipulator;

    /**
     * @var OperatorRepository
     */
    protected $userRepository;

    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    public function __construct(EntityManagerInterface $em, ClientManipulatorInterface $clientManipulator)
    {
        $this->em = $em;
        $this->clientManipulator = $clientManipulator;
        $this->userRepository = $this->em->getRepository(Operator::class);
        $this->messageRepository = $this->em->getRepository(Message::class);
    }

    /**
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        $msg = $topic->broadcast(['msg' => $connection->resourceId . " has joined " . $topic->getId()]);
        /** @var WampConnection $client **/
        foreach ($topic->getIterator() as $client){
            $client->event($topic->getId(), $msg);
        }
    }

    /**
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     */
    public function onUnSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        $msg = $topic->broadcast(['msg' => $connection->resourceId . " has left " . $topic->getId()]);
        /** @var WampConnection $client **/
        foreach ($topic->getIterator() as $client){
            $client->event($topic->getId(), $msg);
        }
    }

    /**
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     * @param $event
     * @param  array $exclude
     * @param  array $eligible
     * @throws \Exception
     */
    public function onPublish(ConnectionInterface $connection, Topic $topic, WampRequest $request, $event, array $exclude, array $eligible)
    {
        $text = $event['message'];
        $from = $event['from'];
        $to = $event['to'];

        /** @var Operator $from */
        $from = $this->userRepository->findOneBy(['id' => $from]);
        /** @var Operator $to */
        $to = $this->userRepository->findOneBy(['id' => $to]);

        $message = new Message($text, new \DateTime('now'), $from, $to);
        $this->em->persist($message);
        $this->em->flush();

        /** @var WampConnection $client **/
        foreach ($topic->getIterator() as $client){
            $client->event($topic->getId(), [
                'message' => $message->getText(),
                'from' => $from->getId(),
                'to' => $to->getId()
            ]);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'chat.topic';
    }
}