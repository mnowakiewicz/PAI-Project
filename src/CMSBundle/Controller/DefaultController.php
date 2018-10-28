<?php

namespace CMSBundle\Controller;


use GoogleBooksBundle\Options\FilterEnum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/cms/a")
     */
    public function indexAction()
    {
        return $this->render('CMS/Index/index.html.twig');
    }
}
