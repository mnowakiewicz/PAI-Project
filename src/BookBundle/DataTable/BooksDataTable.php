<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 03.11.18
 * Time: 18:20
 */

namespace BookBundle\DataTable;


use BookBundle\Entity\Book;
use DataTables\DataTableException;
use DataTables\DataTableHandlerInterface;
use DataTables\DataTableQuery;
use DataTables\DataTableResults;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;

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
        $results->recordsTotal = $this->setTotalNumberOfBooks($results);

        $qb = $repository = $this->entityManager
            ->getRepository('BookBundle:Book')
            ->createQueryBuilder('b');

        $qb = $this->appendSearchConditions($request, $qb);
        $qb = $this->addOrderingToQB($request, $qb);
        $results = $this->setFilteredCount($results, $qb);
        $qb = $this->restrictResults($request, $qb);

        /** @var Book[] $books */
        $books = $qb->getQuery()->getResult();

        $results = $this->setData($books, $results);

        return $results;
    }

    /**
     * @param DataTableQuery $request
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    private function restrictResults(DataTableQuery $request, QueryBuilder $qb):QueryBuilder
    {
        $qb->setMaxResults($request->length);
        $qb->setFirstResult($request->start);

        return $qb;
    }

    /**
     * @param DataTableResults $results
     * @return DataTableResults
     */
    private function setTotalNumberOfBooks(DataTableResults $results): int
    {
        $repository = $this->entityManager->getRepository('BookBundle:Book');
        return $results->recordsTotal = $repository->getAllActiveBooks();
    }

    /**
     * @param DataTableQuery $request
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    private function appendSearchConditions(DataTableQuery $request, QueryBuilder $qb):QueryBuilder
    {
        $expr = new Expr;

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

        return $qb;
    }

    /**
     * @param DataTableQuery $request
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    private function addOrderingToQB(DataTableQuery $request, QueryBuilder $qb):QueryBuilder
    {
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

        return $qb;
    }

    /**
     * @param DataTableResults $results
     * @param QueryBuilder $qb
     * @return DataTableResults
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function setFilteredCount(DataTableResults $results, QueryBuilder $qb):DataTableResults
    {
        $queryCount = clone $qb;
        $queryCount->select('COUNT(b.id)');
        $results->recordsFiltered = $queryCount->getQuery()->getSingleScalarResult();

        return $results;
    }

    /**
     * @param Book[] $books
     * @param DataTableResults $results
     * @return DataTableResults
     */
    private function setData(array $books, DataTableResults $results):DataTableResults
    {
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