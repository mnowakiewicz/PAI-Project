<?php

namespace BookBundle\Entity;

use CommonBundle\Common\CommonSuperClass;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PrintType
 *
 * @ORM\Table(name="printType")
 * @ORM\Entity(repositoryClass="BookBundle\Repository\PrintTypeRepository")
 */
class PrintType extends CommonSuperClass
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="BookBundle\Entity\Book", mappedBy="printType")
     */
    private $books;

    public function __construct(string $name, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->name = $name;
        $this->books = new ArrayCollection();
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     * @return PrintType
     */
    public function setName(?string $name): PrintType
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
     * @return PrintType
     */
    public function setBooks(ArrayCollection $books): PrintType
    {
        $this->books = $books;
        return $this;
    }

    /**
     * @param Book $book
     * @return PrintType
     */
    public function addBook(Book $book):self
    {
        $this->books->add($book);
        return $this;
    }



}

