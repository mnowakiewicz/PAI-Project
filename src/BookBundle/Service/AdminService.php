<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 18.11.18
 * Time: 16:45
 */

namespace BookBundle\Service;


use BookBundle\Entity\Book;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use OperatorBundle\Entity\Operator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class AdminService
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var TokenStorage
     */
    private $securityTokenStorage;

    /**
     * AdminService constructor.
     * @param EntityManager $em
     * @param TokenStorage $securityTokenStorage
     */
    public function __construct(EntityManager $em, TokenStorage $securityTokenStorage)
    {
        $this->em = $em;
        $this->securityTokenStorage = $securityTokenStorage;
    }

    /**
     * Returns true if book got persisted, else if exception occurred returns false
     *
     * @param Book $book
     * @return bool
     */
    public function persistCreatedBook(Book $book): bool
    {
        /** @var Operator $creator */
        $creator = $this->securityTokenStorage->getToken()->getUser();

        if ($book->getImage()) {
            $image = $book->getImage();
            $image->setBook($book);
            $this->em->persist($image);
        }

        $book->setCreator($creator);

        $this->em->persist($book);
        try {
            $this->em->flush();
        } catch (OptimisticLockException $e) {
            return false;
        }
        return true;
    }

    /**
     * Returns true if book got persisted, else if exception occurred returns false
     *
     * @param Book $book
     * @return bool
     * @throws OptimisticLockException
     */
    public function persistEditedBook(Book $book): bool
    {
        /** @var Operator $editor */
        $editor = $this->securityTokenStorage->getToken()->getUser();

        $book->setLastEditor($editor);
        $book->setEditDate(new \DateTime('now'));

        $imgRepo = $this->em->getRepository('ImageBundle:Image');
        $foundImage = $imgRepo->findOneBy(['book' => $book->getId()]);

        if ($foundImage) {
            $foundImage->setBook(null);
            $this->em->persist($foundImage);
            $this->em->flush();
        }

        if ($book->getImage()) {
            $image = $book->getImage();
            $image->setBook($book);
            $this->em->persist($image);
        }

        $this->em->persist($book);
        $this->em->flush();

        return true;
    }
}