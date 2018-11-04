<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 03.11.18
 * Time: 18:20
 */

namespace BookBundle\DataTable;


use BookBundle\Entity\Book;
use DataTables\DataTableHandlerInterface;
use DataTables\DataTableQuery;
use DataTables\DataTableResults;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;

/**
 * Class BooksDataTable
 * @package BookBundle\DataTable
 */
class BooksDataTable implements DataTableHandlerInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * BooksDataTable constructor.
     * @param $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * Handles specified DataTable request.
     *
     * @param DataTableQuery $request
     *
     * @return DataTableResults
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function handle(DataTableQuery $request): DataTableResults
    {
        $results = new DataTableResults();

        $repository  = $this->entityManager->getRepository('BookBundle:Book');

        // Total number of books.
        $results->recordsTotal = $repository->getAllActiveBooks();

        // Query to get requested entities.
        $qb = $repository
            ->createQueryBuilder('b');

        $expr = new Expr;

        // Search.
        if ($request->search->value){
            $qb
                ->where(
                    $expr->orX(
                        $expr->like($expr->lower('b.title'), ":search"),
                        $expr->like($expr->lower('b.subtitle'), ":search"),
                        $expr->like($expr->lower('b.description'), ":search")
                    )
                )
                ->setParameter('search', strtolower('%'.$request->search->value.'%'));
        }

        // Order.
        foreach ($request->order as $order){
            switch ($order->column){
                case 0: $qb->addOrderBy('b.id', $order->dir); break;
                case 1: $qb->addOrderBy('b.title', $order->dir); break;
                case 2: $qb->addOrderBy('b.subtitle', $order->dir); break;
                case 3: $qb->addOrderBy('b.publishedDate', $order->dir); break;
                case 4: $qb->addOrderBy('b.isActive', $order->dir); break;
                case 5: $qb->addOrderBy('b.creationDate', $order->dir); break;
                case 6: $qb->addOrderBy('b.editDate', $order->dir); break;
            }
        }

        // Get filtered count.
        $queryCount = clone $qb;
        $queryCount->select('COUNT(b.id)');
        $results->recordsFiltered = $queryCount->getQuery()->getSingleScalarResult();


        // Restrict results.
        $qb->setMaxResults($request->length);
        $qb->setFirstResult($request->start);

        /** @var Book[] $books */
        $books = $qb->getQuery()->getResult();

        //Response Data
        if(!empty($books)){
            foreach ($books as $book){
                $results->data[] = [
                    $book->getId(),
                    $book->getTitle(),
                    $book->getSubtitle(),
                    $book->getPublishedDate(),
                    $book->isActive(),
                    $book->getCreationDate()->format('l jS F Y h:i:s A'),
                    $book->getEditDate(),
                ];
            }
        }

        return $results;
    }

}