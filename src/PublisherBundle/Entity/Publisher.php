<?php

namespace PublisherBundle\Entity;

use BookBundle\Entity\Book;
use CommonBundle\Common\CommonSuperClass;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Publisher
 *
 * @ORM\Table(name="publisher")
 * @ORM\Entity(repositoryClass="BookBundle\Repository\PrintTypeRepository")
 */
class Publisher extends CommonSuperClass
{

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="BookBundle\Entity\Book", mappedBy="publisher")
     */
    private $books;


    /**
     * Publisher constructor.
     * @param string $name
     * @param bool $isActive
     */
    public function __construct(string $name, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->name = $name;
        $this->books = new ArrayCollection();
    }

    /**
     * @param Book $book
     * @return Publisher
     */
    public function addBook(Book $book):self
    {
        $this->books->add($book);
        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Publisher
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getBooks(): ArrayCollection
    {
        return $this->books;
    }

    /**
     * @param ArrayCollection $books
     * @return Publisher
     */
    public function setBooks(ArrayCollection $books): Publisher
    {
        $this->books = $books;
        return $this;
    }



}

