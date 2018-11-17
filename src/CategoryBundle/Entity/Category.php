<?php

namespace CategoryBundle\Entity;

use BookBundle\Entity\Book;
use CommonBundle\Common\CommonSuperClass;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="CategoryBundle\Repository\CategoryRepository")
 */
class Category extends CommonSuperClass
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="BookBundle\Entity\Book", mappedBy="categories")
     */
    private $books;

    /**
     * Category constructor.
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
     * @return Category
     */
    public function addBook(Book $book):self
    {
        $this->books->add($book);
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
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
     * @return Category
     */
    public function setBooks(ArrayCollection $books): Category
    {
        $this->books = $books;
        return $this;
    }



}

