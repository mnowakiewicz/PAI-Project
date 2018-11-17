<?php

namespace BookBundle\Entity;

use AuthorBundle\Entity\Author;
use BookBundle\Entity\Enum\StatusEnum;
use CategoryBundle\Entity\Category;
use CommonBundle\Common\CommonSuperClass;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ImageBundle\Entity\Image;
use OperatorBundle\Entity\Operator;
use PublisherBundle\Entity\Publisher;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="BookBundle\Repository\BookRepository")
 */
class Book extends CommonSuperClass
{

    /**
     * @var string|null
     *
     * @ORM\Column(name="googleId", nullable=true, unique=true, type="string", length=50, name="googleId")
     */
    private $googleId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etag", nullable=true, type="string", length=50)
     */
    private $etag;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"published"})
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subtitle", type="string", length=50, nullable=true)     *
     */
    private $subtitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="publishedDate", type="string", nullable=true, name="publishedDate")
     */
    private $publishedDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
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
     * @Assert\Url(groups={"published"})
     */
    private $webReaderLink;

    /**
     * @var string
     * @Assert\NotBlank(groups={"published"})
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="AuthorBundle\Entity\Author", inversedBy="books", cascade={"persist"})
     *
     * @var ArrayCollection
     */
    private $authors;

    /**
     * @var PrintType|null
     *
     * @ORM\ManyToOne(targetEntity="BookBundle\Entity\PrintType", inversedBy="books", cascade={"persist"})
     * @ORM\JoinColumn(name="printTypeId", nullable=true, unique=false)
     */
    private $printType;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="CategoryBundle\Entity\Category", inversedBy="books")
     * @Assert\NotBlank(groups={"published"})
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
     * @var Operator|null
     *
     * @ORM\ManyToOne(targetEntity="OperatorBundle\Entity\Operator", inversedBy="booksCreated", cascade={ "persist" })
     * @ORM\JoinColumn(name="creatorId", unique=false, nullable=false)
     */
    private $creator;

    /**
     * @var Operator|null
     *
     * @ORM\ManyToOne(targetEntity="OperatorBundle\Entity\Operator", cascade={"persist"})
     * @ORM\JoinColumn(name="lastEditorId", nullable=true, unique=false)
     */
    private $lastEditor;



    /**
     * Book constructor.
     * @param bool $isActive
     */
    public function __construct(bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->authors = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->status = StatusEnum::DRAFT()->getValue();
    }

    /**
     * @inheritDoc
     */
    protected function serializeThis(): array
    {
        try {
            $reflection = new \ReflectionClass($this);
        } catch (\ReflectionException $e) {
            return [];
        }
        $props = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);
        $parentProps = $reflection->getParentClass()->getProperties(\ReflectionProperty::IS_PROTECTED);

        $return = [];
        foreach ($props as $prop){
            switch ($prop->getName()){
                case 'authors': $return[$prop->getName()] = $this->authors->toArray(); break;
                case 'categories': $return[$prop->getName()] = $this->categories->toArray(); break;
                default: $return[$prop->getName()] = call_user_func_array([$this, 'get' . ucfirst($prop->getName())], []);
            }
        }

        foreach ($parentProps as $parentProp){
            $return[$parentProp->getName()] = call_user_func_array([$this, 'parent::get' . ucfirst($parentProp->getName())], []);
        }

        return $return;
    }


    /**
     * @param Author $author
     * @return Book
     */
    public function addAuthor(Author $author):Book
    {
        $this->authors->add($author);
        return $this;
    }

    /**
     * @param Category $category
     * @return Book
     */
    public function addCategory(Category $category):Book
    {
        $this->categories->add($category);
        return $this;
    }

    /**
     * @return null|string
     */
    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    /**
     * @param null|string $googleId
     * @return Book
     */
    public function setGoogleId(?string $googleId): Book
    {
        $this->googleId = $googleId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getEtag(): ?string
    {
        return $this->etag;
    }

    /**
     * @param null|string $etag
     * @return Book
     */
    public function setEtag(?string $etag): Book
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
    public function setTitle(?string $title): Book
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
    public function setSubtitle(?string $subtitle): Book
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPublishedDate(): ?string
    {
        return $this->publishedDate;
    }

    /**
     * @param null|string $publishedDate
     * @return Book
     */
    public function setPublishedDate(?string $publishedDate): Book
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
    public function setDescription($description): Book
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
    public function setPageCount(?int $pageCount): Book
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
    public function setLanguage(?string $language): Book
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
    public function setWebReaderLink(?string $webReaderLink): Book
    {
        $this->webReaderLink = $webReaderLink;
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
    public function setPrintType(?PrintType $printType): Book
    {
        $this->printType = $printType;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAuthors(): ArrayCollection
    {
        return $this->authors;
    }

    /**
     * @param ArrayCollection $authors
     * @return Book
     */
    public function setAuthors(ArrayCollection $authors): Book
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection $categories
     * @return Book
     */
    public function setCategories(ArrayCollection $categories): Book
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
    public function setPublisher(?Publisher $publisher): Book
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
    public function setImage(?Image $image): Book
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return null|Operator
     */
    public function getCreator(): ?Operator
    {
        return $this->creator;
    }

    /**
     * @param null|Operator $creator
     * @return Book
     */
    public function setCreator(?Operator $creator): Book
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
    public function setLastEditor(?Operator $lastEditor): Book
    {
        $this->lastEditor = $lastEditor;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param StatusEnum $status
     * @return Book
     */
    public function setStatus(StatusEnum $status): Book
    {
        $this->status = $status->getValue();
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorsAsString():string
    {
        $string = '';
        foreach ($this->authors as $author){
            $string .= $author->getFullName() . ' / ';
        }
        return $string;
    }

}

