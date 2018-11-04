<?php

namespace BookBundle\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * BookRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return int
     */
    public function getAllActiveBooks():int
    {

        $qb = $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('count(b.id)')
            ->from('BookBundle:Book', 'b')
            ->where('b.isActive = true');

        try {
            $rows = $qb->getQuery()->getSingleScalarResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            $rows = 0;
        }

        return $rows;
    }
}
