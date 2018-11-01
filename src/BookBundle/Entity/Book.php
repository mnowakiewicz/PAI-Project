<?php

namespace BookBundle\Entity;

use CommonBundle\Entity\CommonSuperClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="BookBundle\Repository\BookRepository")
 */
class Book extends CommonSuperClass
{

    /**
     * @var string
     *
     * @ORM\Column(name="googleId", type="string", length=50, name="googleId")
     */
    private $googleId;

    /**
     * @var string
     *
     * @ORM\Column(name="etag", type="string", length=50)
     */
    private $etag;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subtitle", type="string", length=50, nullable=true)
     */
    private $subtitle;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="publishedDate", type="datetime", nullable=true, name="publishedDate")
     */
    private $publishedDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="pageCount", type="integer", nullable=true, name="pageCount")
     */
    private $pageCount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language", type="string", length=10, nullable=true)
     */
    private $language;

    /**
     * @var string|null
     *
     * @ORM\Column(name="webReaderLink", type="string", length=255, nullable=true, name="webReaderLink")
     */
    private $webReaderLink;


    /**
     * Book constructor.
     * @param string $googleId
     * @param string $etag
     * @param bool $isActive
     */
    public function __construct(string $googleId, string $etag, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->googleId = $googleId;
        $this->etag = $etag;
    }

    /**
     * @return string
     */
    public function getGoogleId(): string
    {
        return $this->googleId;
    }

    /**
     * @param string $googleId
     * @return Book
     */
    public function setGoogleId(string $googleId): Book
    {
        $this->googleId = $googleId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEtag(): string
    {
        return $this->etag;
    }

    /**
     * @param string $etag
     * @return Book
     */
    public function setEtag(string $etag): Book
    {
        $this->etag = $etag;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }


    /**
     * @param string $title
     * @return Book
     */
    public function setTitle(string $title): Book
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }


    /**
     * @param string $subtitle
     * @return Book
     */
    public function setSubtitle(string $subtitle): Book
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getPublishedDate(): ?\DateTime
    {
        return $this->publishedDate;
    }

    /**
     * @param \DateTime $publishedDate
     * @return Book
     */
    public function setPublishedDate(\DateTime $publishedDate): Book
    {
        $this->publishedDate = $publishedDate;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Book
     */
    public function setDescription(string $description): Book
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPageCount(): ?int
    {
        return $this->pageCount;
    }


    /**
     * @param int $pageCount
     * @return Book
     */
    public function setPageCount(int $pageCount): Book
    {
        $this->pageCount = $pageCount;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }


    /**
     * @param string $language
     * @return Book
     */
    public function setLanguage(string $language): Book
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getWebReaderLink(): ?string
    {
        return $this->webReaderLink;
    }


    /**
     * @param string $webReaderLink
     * @return Book
     */
    public function setWebReaderLink(string $webReaderLink): Book
    {
        $this->webReaderLink = $webReaderLink;
        return $this;
    }

}

