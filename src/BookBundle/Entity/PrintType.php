<?php

namespace BookBundle\Entity;

use CommonBundle\Entity\CommonSuperClass;
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @var Book[]
     *
     * @ORM\OneToMany(targetEntity="BookBundle\Entity\Book", mappedBy="printType")
     */
    private $books;

    public function __construct(string $fullName, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->name = $fullName;
        $this->books = [];
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
     * @return PrintType
     */
    public function setName(string $name): PrintType
    {
        $this->name = $name;
        return $this;
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
     * @return PrintType
     */
    public function setBooks(array $books): PrintType
    {
        $this->books = $books;
        return $this;
    }

}

