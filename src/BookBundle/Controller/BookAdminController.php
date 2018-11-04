<?php

namespace BookBundle\Controller;

use GoogleBooksBundle\Options\GoogleBooksAPIRequestParameters;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BookAdminController
 * @package BookBundle\Controller
 *
 * @Route(path="cms/books")
 */
class BookAdminController extends Controller
{
    /**
     * @Route(path="/index")
     */
    public function indexAction():Response
    {
        $parameters = new GoogleBooksAPIRequestParameters('ryby');
        $response = $this->get('google.books.service')->getMappedModel($parameters);
        dump($response);
        return $this->render('CMS/Book/index.html.twig', array(
            // ...
        ));
    }

    public function createBookFromGoogleApiAction():Response
    {

    }

    /**
     * @return Response
     * @Route(path="/index2")
     */
    public function searchBookGoogleApi():Response
    {
        $form = $this->createForm('GoogleBooksBundle\Form\GoogleBooksParametersType');
        return $this->render('CMS/Book/search_book_google.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
