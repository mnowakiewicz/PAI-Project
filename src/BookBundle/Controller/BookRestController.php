<?php

namespace BookBundle\Controller;


use DataTables\DataTablesInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class BookRestController
 * @package BookBundle\Controller
 *
 * @Route(path="/api/v1")
 */
class BookRestController extends Controller
{
    /**
     * @Route("/data_dt", name="api_books_datatable")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function dataTableAction(Request $request)
    {
        $dataTables = $this->get('datatables');
        try {
            $results = $dataTables->handle($request, 'books');
            return $this->json($results);
        }
        catch (HttpException $e) {
            return $this->json($e->getMessage(), $e->getStatusCode());
        }
    }

}
