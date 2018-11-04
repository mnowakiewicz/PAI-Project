<?php

namespace BookBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use GoogleBooksBundle\Options\GoogleBooksAPIRequestParameters;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        $response = $this->get('google.books.service')->getMappedResponseModel($parameters);
        dump($response);

        $books = $this->get('google.books.service')->createBookObjectsFromMappedModel($response);

        dump($books);
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
