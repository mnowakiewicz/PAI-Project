<?php

namespace ImageBundle\Entity;

use BookBundle\Entity\Book;
use CommonBundle\Entity\CommonSuperClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="ImageBundle\Repository\ImageRepository")
 */
class Image extends CommonSuperClass
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumbnail", type="string", length=255, nullable=true)
     */
    private $thumbnail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="smallThumbnail", type="string", length=255, nullable=true, name="smallThumbnail")
     */
    private $smallThumbnail;

    /**
     * @var Book|null
     *
     * @ORM\OneToOne(targetEntity="BookBundle\Entity\Book", inversedBy="image")
     * @ORM\JoinColumn(name="bookId", unique=true, nullable=true)
     */
    private $book;

    /**
     * Image constructor.
     * @param string $fullName
     * @param bool $isActive
     */
    public function __construct(string $fullName, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->name = $fullName;
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
     * @return Image
     */
    public function setName(string $name): Image
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     * @return Image
     */
    public function setUrl(?string $url): Image
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @param null|string $thumbnail
     * @return Image
     */
    public function setThumbnail(?string $thumbnail): Image
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSmallThumbnail(): ?string
    {
        return $this->smallThumbnail;
    }

    /**
     * @param null|string $smallThumbnail
     * @return Image
     */
    public function setSmallThumbnail(?string $smallThumbnail): Image
    {
        $this->smallThumbnail = $smallThumbnail;
        return $this;
    }

    /**
     * @return Book|null
     */
    public function getBook(): ?Book
    {
        return $this->book;
    }

    /**
     * @param Book|null $book
     * @return Image
     */
    public function setBook(?Book $book): Image
    {
        $this->book = $book;
        return $this;
    }


}

