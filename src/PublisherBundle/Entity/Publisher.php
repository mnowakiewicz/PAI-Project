<?php

namespace PublisherBundle\Entity;

use BookBundle\Entity\Book;
use CommonBundle\Common\CommonSuperClass;
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
     * @var Book[]
     *
     * @ORM\OneToMany(targetEntity="BookBundle\Entity\Book", mappedBy="publisher")
     */
    private $books;


    /**
     * Publisher constructor.
     * @param string $fullName
     * @param bool $isActive
     */
    public function __construct(string $fullName, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->name = $fullName;
        $this->books = [];
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
     * @return Book[]
     */
    public function getBooks(): array
    {
        return $this->books;
    }

    /**
     * @param Book[] $books
     * @return Publisher
     */
    public function setBooks(array $books): Publisher
    {
        $this->books = $books;
        return $this;
    }

}

