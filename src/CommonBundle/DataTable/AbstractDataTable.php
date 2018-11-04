<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 04.11.18
 * Time: 13:57
 */

namespace CommonBundle\DataTable;


use CommonBundle\Entity\CommonSuperClass;
use DataTables\DataTableHandlerInterface;
use DataTables\DataTableQuery;
use DataTables\DataTableResults;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;


/**
 * Class AbstractDataTable
 * @package CommonBundle\DataTable
 */
abstract class AbstractDataTable implements DataTableHandlerInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var string
     */
    private $entityName;


    /**
     * AbstractDataTable constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @param DataTableQuery $request
     * @return DataTableResults
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function handle(DataTableQuery $request): DataTableResults
    {
        $array = $this->prepareQueryBuilderAndResultsObjects($request);
        $results = $array['results'];
        $qb = $array['qb'];

        $objects = $qb->getQuery()->getResult();

        $results = $this->setData($objects, $results);

        return $results;
    }

    /**
     * @param DataTableQuery $request
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function prepareQueryBuilderAndResultsObjects(DataTableQuery $request): array
    {
        $results = new DataTableResults();
        $results->recordsTotal = $this->setTotalNumber($results);

        $qb = $repository = $this->entityManager
            ->getRepository($this->getEntityName())
            ->createQueryBuilder('b');

        $qb = $this->appendSearchConditions($request, $qb);
        $qb = $this->addOrderingConditions($request, $qb);
        $results = $this->setFilteredCount($results, $qb);
        $qb = $this->restrictResults($request, $qb);

        return ['qb' => $qb, 'results' => $results];
    }

    /**
     *
     * @param DataTableQuery $request
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    protected function restrictResults(DataTableQuery $request, QueryBuilder $qb): QueryBuilder
    {
        $qb->setMaxResults($request->length);
        $qb->setFirstResult($request->start);

        return $qb;
    }

    /**
     * set and return $results->recordsTotal value
     *
     * Example:
     *
     * $repository = $this->entityManager->getRepository('BookBundle:Book');
     *
     * return $results->recordsTotal = $repository->getAllActiveBooks();
     * @param DataTableResults $results
     * @return int
     */
    abstract protected function setTotalNumber(DataTableResults $results): int;

    /**
     * Example:
     *
     * $expr = new Expr;
     *
     * if ($request->search->value){
     *      $qb
     *          ->where(
     *              $expr->orX(
     *                  $expr->like($expr->lower('b.val1'), ":search"),
     *                  $expr->like($expr->lower('b.val2'), ":search"),
     *                  $expr->like($expr->lower('b.val2'), ":search")
     *              )
     *          )
     *          ->setParameter('search', strtolower('%'.$request->search->value.'%'));
     * }
     *
     * return $qb;
     * @param DataTableQuery $request
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    abstract protected function appendSearchConditions(DataTableQuery $request, QueryBuilder $qb): QueryBuilder;

    /**
     * Example:
     *
     * foreach ($request->order as $order){
     *      switch ($order->column){
     *           case 0: $qb->addOrderBy('b.val1', $order->dir); break;
     *           .
     *           .
     *           .
     *           case 6: $qb->addOrderBy('b.val6', $order->dir); break;
     *      }
     *}
     *
     * return $qb;
     *
     * @param DataTableQuery $request
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    abstract protected function addOrderingConditions(DataTableQuery $request, QueryBuilder $qb): QueryBuilder;


    /**
     * @param DataTableResults $results
     * @param QueryBuilder $qb
     * @return DataTableResults
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function setFilteredCount(DataTableResults $results, QueryBuilder $qb): DataTableResults
    {
        $queryCount = clone $qb;
        $queryCount->select('COUNT(b.id)');
        $results->recordsFiltered = $queryCount->getQuery()->getSingleScalarResult();

        return $results;
    }

    /**
     * Example:
     *
     * if(!empty($books)){
     *      foreach ($books as $book){
     *          $results->data[] = [
     *              $book->getId(),
     *              $book->getTitle(),
     *              $book->getSubtitle(),
     *              $book->getPublishedDate(),
     *              $book->isActive(),
     *              $book->getCreationDate()->format('l jS F Y h:i:s A'),
     *              $book->getEditDate(),
     *          ];
     *      }
     *}
     *
     * return $results;
     *
     * @param CommonSuperClass[] $objects
     * @param DataTableResults $results
     * @return DataTableResults
     */
    abstract protected function setData(array $objects, DataTableResults $results): DataTableResults;


    /**
     * Example:
     *
     * $this->entityName = "BookBundle:Book'";
     *
     */
    abstract public function setEntityName(): void;

    /**
     * @return string
     */
    public function getEntityName(): string
    {
        return $this->entityName;
    }
}