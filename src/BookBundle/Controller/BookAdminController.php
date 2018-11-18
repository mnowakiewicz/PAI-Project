<?php

namespace BookBundle\Controller;

use BookBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route(name="books_cms_index", methods={"GET"})
     */
    public function indexAction(): Response
    {
        return $this->render('CMS/Book/index.html.twig');
    }

    /**
     * @return Response
     * @Route(path="/google-api", name="books_cms_google_api", methods={"GET", "POST"})
     */
    public function googleBooksAPIAction(): Response
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
    public function createAction(Request $request): Response
    {
        $adminService = $this->get('book_admin.service');
        $form = $this->createForm('BookBundle\Form\BookType');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Book $book */
            $book = $form->getData();
            $adminService->persistCreatedBook($book);
            return $this->redirectToRoute('books_cms_index');
        }
        return $this->render('CMS/Common/create_edit.html.twig', [
            'form' => $form->createView(),
            'title' => 'Create Book',
            'submit_button_text' => 'Create'
        ]);
    }

    /**
     * @Route(path="/edit/{id}", name="books_cms_edit")
     * @ParamConverter(name="book", class="BookBundle\Entity\Book", isOptional=false)
     *
     * @param Request $request
     * @param Book $book
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editAction(Request $request, Book $book): Response
    {
        $adminService = $this->get('book_admin.service');
        $form = $this->createForm('BookBundle\Form\BookType', $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Book $book */
            $book = $form->getData();
            $adminService->persistEditedBook($book);
            return $this->redirectToRoute('books_cms_index');
        }

        return $this->render('CMS/Common/create_edit.html.twig', [
            'form' => $form->createView(),
            'title' => 'Edit Book',
            'submit_button_text' => 'Edit'
        ]);
    }


}
