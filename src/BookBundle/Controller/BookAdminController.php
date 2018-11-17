<?php

namespace BookBundle\Controller;

use BookBundle\Entity\Book;
use OperatorBundle\Entity\Operator;
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
        return $this->render('CMS/Book/index.html.twig');
    }

    /**
     * @return Response
     * @Route(path="/google-api", name="books_cms_google_api", methods={"GET", "POST"})
     */
    public function googleBooksAPIAction():Response
    {
        $form = $this->createForm('GoogleBooksBundle\Form\GoogleBooksParametersType');
        return $this->render('CMS/Book/search_book_google.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route(path="/create", name="books_cms_create", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request):Response
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('BookBundle\Form\BookType');

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var Book $book */
            $book = $form->getData();

            /** @var Operator $creator */
            $creator = $this->getUser();

            $book->setCreator($creator);

            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('books_cms_index');
        }
        return $this->render('CMS/Common/create.html.twig', [
            'form' => $form->createView(),
            'title' => 'Create Book'
        ]);
    }



}
