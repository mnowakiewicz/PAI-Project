<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 06.01.19
 * Time: 16:39
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


/**
 * Class NotificationTopic
 * @package WebSocketBundle\Topic
 */
class ActiveUsersTopic implements TopicInterface
{
    /**
     * @var Operator[]
     */
    protected $activeUsers;

    /**
     * @var Operator[]
     */
    protected $inactiveUsers;
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
     * ActiveUsersTopic constructor.
     * @param EntityManagerInterface $em
     * @param ClientManipulatorInterface $clientManipulator
     */
    public function __construct(EntityManagerInterface $em, ClientManipulatorInterface $clientManipulator)
    {
        $this->em = $em;
        $this->clientManipulator = $clientManipulator;
        $this->userRepository = $this->em->getRepository(Operator::class);
    }

    public function setActiveAndInactiveUsers(): void
    {
        /** @var Operator[] $users */
        $this->activeUsers = $this->userRepository
            ->findBy([
                'isActive' => true,
                'isActiveNow' => true
            ]);

        $this->inactiveUsers = $this->userRepository
            ->findBy([
                'isActive' => true,
                'isActiveNow' => false
            ]);
    }

    protected function userDTO(Operator $user): array
    {
        return [
            'username' => $user->getUsername(),
            'id' => $user->getId(),
            'name' => $user->getName(),
            'lastName' => $user->getLastName(),
        ];
    }

    protected function activeUsersDTO(): array
    {
        $activeUsersDTO = [];
        foreach ($this->activeUsers as $user) {
            $username = $user->getUsername();
            $activeUsersDTO[$username] = [
                'username' => $username,
                'id' => $user->getId(),
                'name' => $user->getName(),
                'lastName' => $user->getLastName()
            ];
        }

        return $activeUsersDTO;
    }

    protected function getInactiveUsersDTO(): array
    {
        $inactiveUsersDTO = [];

        $now = new \DateTime('now');

        foreach ($this->inactiveUsers as $user) {

            $lastActivityAt = $user->getLastActivityAt();
            if ($lastActivityAt && $lastActivityAt->format('y/m/d') === $now->format('y/m/d')) {
                $lastActivityAt = $lastActivityAt->format('h:m');
            } elseif ($lastActivityAt) {
                $lastActivityAt = $now->diff($lastActivityAt)->format('d') . 'days ago';
            } else {
                $lastActivityAt = '';
            }

            $username = $user->getUsername();
            $inactiveUsersDTO[$username] = [
                'username' => $username,
                'id' => $user->getId(),
                'name' => $user->getName(),
                'lastName' => $user->getLastName(),
                'lastActivityAt' => $lastActivityAt
            ];
        }

        return $inactiveUsersDTO;
    }

    /**
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     * @throws \Exception
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request): void
    {
        $client = $this->clientManipulator->getClient($connection);

       if(is_object($client)) {
           $username = $client->getUsername();
           /** @var null|Operator $activeUser */
           $activeUser = $this->userRepository->findOneBy([
               'username' => $username
           ]);

           $activeUser->setLastActivityAt(new \DateTime('now'));
           $activeUser->setIsActiveNow(true);
           $this->em->persist($activeUser);
           $this->em->flush();
       }

        $this->setActiveAndInactiveUsers();

        $topic->broadcast([
            'joined' => $this->userDTO($activeUser),
            'activeUsers' => $this->activeUsersDTO(),
            'inactiveUsers' => $this->getInactiveUsersDTO()
        ]);
    }

    /**
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     * @throws \Exception
     */
    public function onUnSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request):void
    {
        $client = $this->clientManipulator->getClient($connection);

        if(is_object($client)){
            $username = $this->clientManipulator->getClient($connection)->getUsername();
            /** @var null|Operator $inactiveUser */
            $inactiveUser = $this->userRepository->findOneBy([
                'username' => $username
            ]);

            $inactiveUser->setLastActivityAt(new \DateTime('now'));
            $inactiveUser->setIsActiveNow(false);
            $this->em->persist($inactiveUser);
            $this->em->flush();
        }

        $this->setActiveAndInactiveUsers();

        $topic->broadcast([
            'left' => $this->userDTO($inactiveUser),
            'activeUsers' => $this->activeUsersDTO(),
            'inactiveUsers' => $this->getInactiveUsersDTO()
        ]);
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