<?php

namespace BookBundle\Controller;

use GoogleBooksBundle\Options\GoogleBooksAPIRequestParameters;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
    public function indexAction()
    {
        $parameters = new GoogleBooksAPIRequestParameters('ryby');
        $response = $this->get('google.books.service')->getMappedModel($parameters);
        dump($response);
        return $this->render('CMS/Index/index.html.twig', array(
            // ...
        ));
    }

}
