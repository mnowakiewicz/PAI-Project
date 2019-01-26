<?php

namespace WebSocketBundle\Repository;

use OperatorBundle\Entity\Operator;
use WebSocketBundle\Entity\Message;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends \Doctrine\ORM\EntityRepository
{


    /**
     * @param Operator $from
     * @param Operator $to
     * @param int $numberOfMessages
     * @return Message[]
     */
    public function findAllLastMessagesByUsers(Operator $from, Operator $to, int $numberOfMessages = 10): array
    {
        $qb = $this->createQueryBuilder('message');

        return $qb
            ->join('message.from', 'from')
            ->join('message.to', 'to')
            ->where(
                $qb->expr()->orX(
                    $qb->expr()->andX(
                        $qb->expr()->eq('message.from', ':fromId'),
                        $qb->expr()->eq('message.to', ':toId')
                    ),
                    $qb->expr()->andX(
                        $qb->expr()->eq('message.from', ':toId'),
                        $qb->expr()->eq('message.to', ':fromId')
                    )
                )
            )
            ->setParameters([
                'fromId' => $from->getId(),
                'toId' => $to->getId()
            ])
            ->setMaxResults($numberOfMessages)
            ->orderBy('message.creationDate', 'DESC')
            ->getQuery()
            ->execute();
    }


}
