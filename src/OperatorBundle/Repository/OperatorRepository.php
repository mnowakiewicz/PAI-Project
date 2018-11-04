<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 21.10.18
 * Time: 20:20
 */

namespace OperatorBundle\Repository;


use Doctrine\ORM\EntityRepository;
use OperatorBundle\Entity\Operator;

/**
 * Class OperatorRepository
 * @package OperatorBundle\Repository
 */
class OperatorRepository extends EntityRepository
{
    /**
     * @param string $username
     * @return Operator
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    function getOperatorByUsername(string $username):Operator
    {
        $qb = $this->createQueryBuilder('o')
            ->where('o.username = :username')
            ->setParameter('username', $username)
            ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }
}