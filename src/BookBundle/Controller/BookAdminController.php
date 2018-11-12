<?php

namespace BookBundle\Controller;

use BookBundle\Entity\Book;
use GoogleBooksBundle\Options\GoogleBooksParameters;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route(path="/index", name="books_cms_index", methods={"GET"})
     */
    public function indexAction():Response
    {
        $parameters = new GoogleBooksParameters('ryby');
        $response = $this->get('google.books.service')->getMappedResponseModel($parameters);

        $books = $this->get('google.books.service')->createBookObjectsFromMappedModel($response);


        return $this->render('CMS/Book/index.html.twig', array(
            // ...
        ));
    }

    /**
     * @return Response
     * @Route(path="/google-api", name="books_cms_google_api", methods={"GET"})
     */
    public function googleBooksAPIAction():Response
    {
        $form = $this->createForm('GoogleBooksBundle\Form\GoogleBooksParametersType');

        return $this->render('CMS/Book/search_book_google.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route(path="/create", name="books_cms_create", methods={"POST")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request):Response
    {
        $book = new Book();
        $form = $this->createForm('BookBundle\Form\BookType', $book);


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $book = $form->getData();

            return $this->redirectToRoute('books_cms_index');
        }
        return $this->render('CMS/Book/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
