<?php

namespace CMSBundle\Controller;


use GoogleBooksBundle\Options\FilterEnum;
use GoogleBooksBundle\Options\GoogleBooksAPIRequestParameters;
use GoogleBooksBundle\Options\OrderByEnum;
use GoogleBooksBundle\Options\PrintTypeEnum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/cms/a")
     */
    public function indexAction()
    {

        $parameters = new GoogleBooksAPIRequestParameters('bibla');
        $parameters->setMaxResults(10);
        dump($service = $this->get('google.books.service')->getMappedModel($parameters));
        return $this->render('CMS/Index/index.html.twig');
    }
}
