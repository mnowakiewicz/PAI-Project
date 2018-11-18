<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 12.11.18
 * Time: 18:32
 */

namespace BookBundle\Service;


use AuthorBundle\Entity\Author;
use Beta\B;
use BookBundle\Entity\Book;
use BookBundle\Entity\Enum\StatusEnum;
use CategoryBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use ImageBundle\Entity\Image;
use PublisherBundle\Entity\Publisher;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class RestService
 * @package BookBundle\Service
 */
class RestService
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
     * RestService constructor.
     * @param EntityManager $em
     * @param TokenStorage $securityTokenStorage
     */
    public function __construct(EntityManager $em, TokenStorage $securityTokenStorage)
    {
        $this->em = $em;
        $this->securityTokenStorage = $securityTokenStorage;
    }


    /**
     * Returns true if book got persisted
     *
     * @param array $jsonData
     * @return bool
     */
    public function persistBookObject(array $jsonData):bool
    {

        $book = $this->mapToBookObj($jsonData);

        $alreadyExists = $this->em
            ->getRepository('BookBundle:Book')
            ->ifExistsByGivenGoogleId($book->getGoogleId());

        if($alreadyExists)
            return false;

        $this->em->persist($book);

        if ($book->getImage()){
            $image = $book->getImage();
            $image->setBook($book);
            $this->em->persist($image);
        }

        try {
            $this->em->flush();
        } catch (OptimisticLockException $e) {
            return false;
        }

        return true;
    }


    /**
     * @param array $jsonData
     * @return Book
     */
    private function mapToBookObj(array $jsonData):Book
    {
        $printTypeRepo = $this->em->getRepository('BookBundle:PrintType');

        $book = new Book();

        $book
            ->setGoogleId($jsonData['googleId'])
            ->setEtag($jsonData['etag'])
            ->setTitle($jsonData['title'])
            ->setSubtitle($jsonData['subtitle'])
            ->setPublishedDate($jsonData['publishedDate'])
            ->setDescription($jsonData['description'])
            ->setPageCount($jsonData['pageCount'])
            ->setLanguage($jsonData['language'])
            ->setWebReaderLink($jsonData['webReaderLink'])
            ->setStatus(StatusEnum::DRAFT())
            ->setPrintType($printTypeRepo->getPrintTypeByName($jsonData['printType']['name']))
            ->setCreator($this->securityTokenStorage->getToken()->getUser())
            ->setCreationDate(new \DateTime('now'));

        $book = $this->addPublisher($book, $jsonData['publisher']);
        $book = $this->addAuthors($book, $jsonData['authors']);
        $book = $this->addImage($book, $jsonData['image']);
        $book = $this->addCategories($book, $jsonData['categories']);

        return $book;
    }

    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    private function addPublisher(Book $book, array $data): Book
    {
        $repository = $this->em->getRepository('PublisherBundle:Publisher');
        if ($data == null)
            return $book;

        $criteria = ['name' => $data['name']];
        $isInDataBase = count($repository->findBy($criteria)) > 0 ? true : false;

        if ($isInDataBase){
            /** @var Publisher $publisher */
            $publisher = $repository->findOneBy($criteria);
        } else {
            $publisher = new Publisher($data['name']);
            $publisher
                ->setCreationDate(new \DateTime('now'));
        }

        $book->setPublisher($publisher);


        return $book;
    }


    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    private function addAuthors(Book $book, array $data):Book
    {
        $repository = $this->em->getRepository('AuthorBundle:Author');
        foreach ($data as $value){
            $criteria = ['fullName' => $value['fullName']];
            $isInDatabase = count($repository->findBy($criteria)) > 0 ? true : false;

            if ($isInDatabase){
                /** @var Author $author */
                $author = $repository->findOneBy($criteria);
            } else {
                $author = new Author($value['fullName']);
                $author
                    ->setPseudonym($value['pseudonym'])
                    ->setAbout($value['about'])
                    ->setCreationDate(new \DateTime('now'));
            }

            $book->addAuthor($author);
        }

        return $book;
    }

    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    private function addImage(Book $book, array $data):Book
    {
        $image = new Image($data['name']);

        $image
            ->setUrl($data['url'])
            ->setThumbnail($data['thumbnail'])
            ->setSmallThumbnail($data['smallThumbnail'])
            ->setCreationDate(new \DateTime('now'));

        $book->setImage($image);

        return $book;
    }


    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    private function addCategories(Book $book, array $data):Book
    {
        $repository = $this->em->getRepository('CategoryBundle:Category');

        if ($data == null)
            return $book;

        foreach ($data as $value){
            $criteria = ['name' => $value['name']];
            $isInDataBase = count($repository->findBy($criteria)) > 0 ? true : false;

            if ($isInDataBase){
                /** @var Category $category */
                $category = $repository->findOneBy($criteria);
            } else {
                $category = new Category($value['name']);
                $category
                    ->setCreationDate(new \DateTime('now'));
            }

            $book->addCategory($category);
        }

        return $book;
    }


}