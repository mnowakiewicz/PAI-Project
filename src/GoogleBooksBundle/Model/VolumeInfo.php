<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:49
 */

namespace GoogleBooksBundle\Model;


/**
 * Class VolumeInfo
 * @package BookBundle\Model
 */
class VolumeInfo
{
    /**
     * @var string|null
     */
    private $title;
    /**
     * @var string|null
     */
    private $subtitle;

    /**
     * @var array
     */
    private $authors;
    /**
     * @var string|null
     */
    private $publishedDate;
    /**
     * @var string|null
     */
    private $publisher;
    /**
     * @var string|null
     */
    private $description;
    /**
     * @var ReadingModes|null
     */
    private $readingModes;
    /**
     * @var integer|null
     */
    private $pageCount;
    /**
     * @var string|null
     */
    private $printType;
    /**
     * @var string|null
     */
    private $maturityRating;
    /**
     * @var boolean|null
     */
    private $allowAnonLogging;
    /**
     * @var string|null
     */
    private $contentVersion;
    /**
     * @var ImageLinks
     */
    private $imageLinks;
    /**
     * @var string|null
     */
    private $language;
    /**
     * @var string|null
     */
    private $previewLink;
    /**
     * @var string|null
     */
    private $infoLink;
    /**
     * @var string|null
     */
    private $canonicalVolumeLink;

    /**
     * @var IndustryIdentifier[]|null
     */
    private $industryIdentifiers;
    /**
     * @var array|null
     */
    private $categories;


    /**
     * VolumeInfo constructor.
     */
    public function __construct()
    {
        $this->authors = [];
        $this->imageLinks = new ImageLinks();
    }

    /**
     * @param array $volumeInfoData
     * @return VolumeInfo
     * @throws \ReflectionException
     */
    public static function create(array $volumeInfoData): VolumeInfo
    {
        $volumeInfo = new VolumeInfo();
        $reflection = new \ReflectionClass($volumeInfo);
        $props = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);

        foreach ($props as $prop){
            $propName = $prop->getName();

            if(array_key_exists($propName, $volumeInfoData)){
                $functionName = 'set' . ucfirst($prop->getName());
                $data = $volumeInfoData[$propName];

                switch ($propName){
                    case 'readingModes':
                        call_user_func_array([$volumeInfo, $functionName], [ReadingModes::create($data)]);
                        break;
                    case 'imageLinks':
                        call_user_func_array([$volumeInfo, $functionName], [ImageLinks::create($data)]);
                        break;
                    case 'industryIdentifiers':
                        $identifiers = array_map(function ($data){
                            return IndustryIdentifier::create($data);
                            }, $data);
                        call_user_func_array([$volumeInfo, $functionName], [$identifiers]);
                        break;
                    default:
                        call_user_func_array([$volumeInfo, $functionName], [$data]);
                }
            }
        }

        return $volumeInfo;
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
     * @return VolumeInfo
     */
    public function setTitle(?string $title): VolumeInfo
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
     * @return VolumeInfo
     */
    public function setSubtitle(?string $subtitle): VolumeInfo
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
     * @return VolumeInfo
     */
    public function setPublishedDate(?string $publishedDate): VolumeInfo
    {
        $this->publishedDate = $publishedDate;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    /**
     * @param null|string $publisher
     * @return VolumeInfo
     */
    public function setPublisher(?string $publisher): VolumeInfo
    {
        $this->publisher = $publisher;
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
     * @return VolumeInfo
     */
    public function setDescription(?string $description): VolumeInfo
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ReadingModes|null
     */
    public function getReadingModes(): ?ReadingModes
    {
        return $this->readingModes;
    }

    /**
     * @param ReadingModes|null $readingModes
     * @return VolumeInfo
     */
    public function setReadingModes(?ReadingModes $readingModes): VolumeInfo
    {
        $this->readingModes = $readingModes;
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
     * @return VolumeInfo
     */
    public function setPageCount(?int $pageCount): VolumeInfo
    {
        $this->pageCount = $pageCount;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPrintType(): ?string
    {
        return $this->printType;
    }

    /**
     * @param null|string $printType
     * @return VolumeInfo
     */
    public function setPrintType(?string $printType): VolumeInfo
    {
        $this->printType = $printType;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMaturityRating(): ?string
    {
        return $this->maturityRating;
    }

    /**
     * @param null|string $maturityRating
     * @return VolumeInfo
     */
    public function setMaturityRating(?string $maturityRating): VolumeInfo
    {
        $this->maturityRating = $maturityRating;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowAnonLogging(): ?bool
    {
        return $this->allowAnonLogging;
    }

    /**
     * @param bool|null $allowAnonLogging
     * @return VolumeInfo
     */
    public function setAllowAnonLogging(?bool $allowAnonLogging): VolumeInfo
    {
        $this->allowAnonLogging = $allowAnonLogging;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getContentVersion(): ?string
    {
        return $this->contentVersion;
    }

    /**
     * @param null|string $contentVersion
     * @return VolumeInfo
     */
    public function setContentVersion(?string $contentVersion): VolumeInfo
    {
        $this->contentVersion = $contentVersion;
        return $this;
    }

    /**
     * @return ImageLinks|null
     */
    public function getImageLinks(): ?ImageLinks
    {
        return $this->imageLinks;
    }

    /**
     * @param ImageLinks|null $imageLinks
     * @return VolumeInfo
     */
    public function setImageLinks(?ImageLinks $imageLinks): VolumeInfo
    {
        $this->imageLinks = $imageLinks;
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
     * @return VolumeInfo
     */
    public function setLanguage(?string $language): VolumeInfo
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPreviewLink(): ?string
    {
        return $this->previewLink;
    }

    /**
     * @param null|string $previewLink
     * @return VolumeInfo
     */
    public function setPreviewLink(?string $previewLink): VolumeInfo
    {
        $this->previewLink = $previewLink;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getInfoLink(): ?string
    {
        return $this->infoLink;
    }

    /**
     * @param null|string $infoLink
     * @return VolumeInfo
     */
    public function setInfoLink(?string $infoLink): VolumeInfo
    {
        $this->infoLink = $infoLink;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCanonicalVolumeLink(): ?string
    {
        return $this->canonicalVolumeLink;
    }

    /**
     * @param null|string $canonicalVolumeLink
     * @return VolumeInfo
     */
    public function setCanonicalVolumeLink(?string $canonicalVolumeLink): VolumeInfo
    {
        $this->canonicalVolumeLink = $canonicalVolumeLink;
        return $this;
    }

    /**
     * @return IndustryIdentifier[]|null
     */
    public function getIndustryIdentifiers(): ?array
    {
        return $this->industryIdentifiers;
    }

    /**
     * @param IndustryIdentifier[]|null $industryIdentifiers
     * @return VolumeInfo
     */
    public function setIndustryIdentifiers(?array $industryIdentifiers): VolumeInfo
    {
        $this->industryIdentifiers = $industryIdentifiers;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }

    /**
     * @param array|null $categories
     * @return VolumeInfo
     */
    public function setCategories(?array $categories): VolumeInfo
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @param array $authors
     * @return VolumeInfo
     */
    public function setAuthors(array $authors): VolumeInfo
    {
        $this->authors = $authors;
        return $this;
    }





}