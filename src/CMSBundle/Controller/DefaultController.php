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
        $parameters = new GoogleBooksAPIRequestParameters();
        $parameters->setOrderBy(OrderByEnum::RELEVANCE())
            ->setPrintType(PrintTypeEnum::MAGAZINES());

        dump($parameters->getPrintType());
        $parameters->parametersToString();
        return $this->render('CMS/Index/index.html.twig');
    }
}
