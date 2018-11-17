<?php

namespace AuthorBundle\Entity;

use BookBundle\Entity\Book;
use CommonBundle\Common\CommonSuperClass;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="AuthorBundle\Repository\AuthorRepository")
 */
class Author extends CommonSuperClass
{

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $fullName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $pseudonym;


    /**
     * @var null|\DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, name="birthDate")
     */
    private $birthDate;

    /**
     * @var null|\DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, name="deathDate")
     */
    private $deathDate;

    /**
     * @var null|string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $about;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="BookBundle\Entity\Book", mappedBy="authors")
     */
    private $books;

    /**
     * Author constructor.
     * @param string $name
     * @param bool $isActive
     */
    public function __construct(string $name, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->fullName = $name;
        $this->books = new ArrayCollection();
    }


    /**
     * @param Book $book
     * @return Author
     */
    public function addBook(Book $book):Author
    {
        $this->books->add($book);
        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return Author
     */
    public function setFullName(string $fullName): Author
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPseudonym(): ?string
    {
        return $this->pseudonym;
    }

    /**
     * @param null|string $pseudonym
     * @return Author
     */
    public function setPseudonym(?string $pseudonym): Author
    {
        $this->pseudonym = $pseudonym;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime|null $birthDate
     * @return Author
     */
    public function setBirthDate(?\DateTime $birthDate): Author
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeathDate(): ?\DateTime
    {
        return $this->deathDate;
    }

    /**
     * @param \DateTime|null $deathDate
     * @return Author
     */
    public function setDeathDate(?\DateTime $deathDate): Author
    {
        $this->deathDate = $deathDate;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAbout(): ?string
    {
        return $this->about;
    }

    /**
     * @param null|string $about
     * @return Author
     */
    public function setAbout(?string $about): Author
    {
        $this->about = $about;
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
     * @return Author
     */
    public function setBooks(ArrayCollection $books): Author
    {
        $this->books = $books;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string) $this->getFullName();
    }


}

