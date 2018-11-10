<?php

namespace BookBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class BookRestController
 * @package BookBundle\Controller
 *
 * @Route(path="/api/v1")
 */
class RestBookControllerController extends Controller
{
    /**
     * @Route("/datatable/data", name="api_books_datatable_data")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function dataTableAction(Request $request):JsonResponse
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

    /**
     * @Route("/googlebooks/books", name="api_googlebooks_get")
     * @Method(methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getGoogleBooksAction(Request $request):JsonResponse
    {
        $googleService = $this->get('google.books.service');
        $googleParams = $googleService->mapFormToGoogleBookParameters($request->request->get('googlebundle_parameters'));
        $mappedModel = $googleService->getMappedResponseModel($googleParams);
        $return = $googleService->createBookObjectsFromMappedModel($mappedModel);

        return $this->json(json_encode($return));
    }

}


