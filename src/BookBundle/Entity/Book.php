<?php

namespace BookBundle\Entity;

use AuthorBundle\Entity\Author;
use CategoryBundle\Entity\Category;
use CommonBundle\Entity\CommonSuperClass;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ImageBundle\Entity\Image;
use OperatorBundle\Entity\Operator;
use PublisherBundle\Entity\Publisher;

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
     * @ORM\ManyToMany(targetEntity="AuthorBundle\Entity\Author", inversedBy="books")
     *
     * @var Author[]
     */
    private $authors;

    /**
     * @var PrintType|null
     *
     * @ORM\ManyToOne(targetEntity="BookBundle\Entity\PrintType", inversedBy="books")
     * @ORM\JoinColumn(name="printTypeId", nullable=true, unique=false)
     */
    private $printType;

    /**
     * @var Category[]
     *
     * @ORM\ManyToMany(targetEntity="CategoryBundle\Entity\Category", inversedBy="books")
     */
    private $categories;

    /**
     * @var Publisher|null
     *
     * @ORM\ManyToOne(targetEntity="PublisherBundle\Entity\Publisher", inversedBy="books")
     * @ORM\JoinColumn(name="publisherId", nullable=true, unique=false)
     */
    private $publisher;

    /**
     * @var Image|null
     *
     * @ORM\OneToOne(targetEntity="ImageBundle\Entity\Image",mappedBy="book", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @var Operator
     *
     * @ORM\ManyToOne(targetEntity="OperatorBundle\Entity\Operator", inversedBy="booksCreated")
     * @ORM\JoinColumn(name="creatorId", unique=false, nullable=false)
     */
    private $creator;

    /**
     * @var Operator|null
     *
     * @ORM\ManyToOne(targetEntity="OperatorBundle\Entity\Operator")
     * @ORM\JoinColumn(name="lastEditorId", nullable=true, unique=false)
     */
    private $lastEditor;

    /**
     * Book constructor.
     * @param Operator $creator
     * @param string $googleId
     * @param string $etag
     * @param bool $isActive
     */
    public function __construct(Operator $creator, string $googleId, string $etag, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->googleId = $googleId;
        $this->etag = $etag;
        $this->authors = [];
        $this->categories = [];
        $this->creator = $creator;
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
     * @param null|string $title
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
     * @param null|string $subtitle
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
     * @param \DateTime|null $publishedDate
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
     * @param null|string $description
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
     * @param int|null $pageCount
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
     * @param null|string $language
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
     * @param null|string $webReaderLink
     * @return Book
     */
    public function setWebReaderLink(string $webReaderLink): Book
    {
        $this->webReaderLink = $webReaderLink;
        return $this;
    }

    /**
     * @return Author[]
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @param Author[] $authors
     * @return Book
     */
    public function setAuthors(array $authors): Book
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * @return PrintType|null
     */
    public function getPrintType(): ?PrintType
    {
        return $this->printType;
    }

    /**
     * @param PrintType|null $printType
     * @return Book
     */
    public function setPrintType(PrintType $printType): Book
    {
        $this->printType = $printType;
        return $this;
    }

    /**
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param Category[] $categories
     * @return Book
     */
    public function setCategories(array $categories): Book
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return null|Publisher
     */
    public function getPublisher(): ?Publisher
    {
        return $this->publisher;
    }

    /**
     * @param null|Publisher $publisher
     * @return Book
     */
    public function setPublisher(Publisher $publisher): Book
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * @param Image|null $image
     * @return Book
     */
    public function setImage(Image $image): Book
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return Operator
     */
    public function getCreator(): Operator
    {
        return $this->creator;
    }

    /**
     * @param Operator $creator
     * @return Book
     */
    public function setCreator(Operator $creator): Book
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * @return null|Operator
     */
    public function getLastEditor(): ?Operator
    {
        return $this->lastEditor;
    }

    /**
     * @param null|Operator $lastEditor
     * @return Book
     */
    public function setLastEditor(Operator $lastEditor): Book
    {
        $this->lastEditor = $lastEditor;
        return $this;
    }


}

