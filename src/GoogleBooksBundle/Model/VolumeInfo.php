<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:49
 */

namespace BookBundle\Model;


/**
 * Class VolumeInfo
 * @package BookBundle\Model
 */
class VolumeInfo
{
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $publishedDate;
    /**
     * @var string
     */
    private $description;
    /**
     * @var ReadingMode
     */
    private $readingModes;
    /**
     * @var integer
     */
    private $pageCount;
    /**
     * @var string
     */
    private $printType;
    /**
     * @var string
     */
    private $maturityRating;
    /**
     * @var boolean
     */
    private $allowAnonLoggin;
    /**
     * @var string
     */
    private $contentVersion;
    /**
     * @var ImageLink
     */
    private $imageLinks;
    /**
     * @var string
     */
    private $language;
    /**
     * @var string
     */
    private $previewLink;
    /**
     * @var string
     */
    private $infoLink;
    /**
     * @var string
     */
    private $canonicalVolumeLink;

    /**
     * VolumeInfo constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return VolumeInfo
     */
    public function setTitle(string $title): VolumeInfo
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getPublishedDate(): string
    {
        return $this->publishedDate;
    }

    /**
     * @param string $publishedDate
     * @return VolumeInfo
     */
    public function setPublishedDate(string $publishedDate): VolumeInfo
    {
        $this->publishedDate = $publishedDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return VolumeInfo
     */
    public function setDescription(string $description): VolumeInfo
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ReadingMode
     */
    public function getReadingModes(): ReadingMode
    {
        return $this->readingModes;
    }

    /**
     * @param ReadingMode $readingModes
     * @return VolumeInfo
     */
    public function setReadingModes(ReadingMode $readingModes): VolumeInfo
    {
        $this->readingModes = $readingModes;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    /**
     * @param int $pageCount
     * @return VolumeInfo
     */
    public function setPageCount(int $pageCount): VolumeInfo
    {
        $this->pageCount = $pageCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrintType(): string
    {
        return $this->printType;
    }

    /**
     * @param string $printType
     * @return VolumeInfo
     */
    public function setPrintType(string $printType): VolumeInfo
    {
        $this->printType = $printType;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaturityRating(): string
    {
        return $this->maturityRating;
    }

    /**
     * @param string $maturityRating
     * @return VolumeInfo
     */
    public function setMaturityRating(string $maturityRating): VolumeInfo
    {
        $this->maturityRating = $maturityRating;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAllowAnonLoggin(): bool
    {
        return $this->allowAnonLoggin;
    }

    /**
     * @param bool $allowAnonLoggin
     * @return VolumeInfo
     */
    public function setAllowAnonLoggin(bool $allowAnonLoggin): VolumeInfo
    {
        $this->allowAnonLoggin = $allowAnonLoggin;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentVersion(): string
    {
        return $this->contentVersion;
    }

    /**
     * @param string $contentVersion
     * @return VolumeInfo
     */
    public function setContentVersion(string $contentVersion): VolumeInfo
    {
        $this->contentVersion = $contentVersion;
        return $this;
    }

    /**
     * @return ImageLink
     */
    public function getImageLinks(): ImageLink
    {
        return $this->imageLinks;
    }

    /**
     * @param ImageLink $imageLinks
     * @return VolumeInfo
     */
    public function setImageLinks(ImageLink $imageLinks): VolumeInfo
    {
        $this->imageLinks = $imageLinks;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return VolumeInfo
     */
    public function setLanguage(string $language): VolumeInfo
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreviewLink(): string
    {
        return $this->previewLink;
    }

    /**
     * @param string $previewLink
     * @return VolumeInfo
     */
    public function setPreviewLink(string $previewLink): VolumeInfo
    {
        $this->previewLink = $previewLink;
        return $this;
    }

    /**
     * @return string
     */
    public function getInfoLink(): string
    {
        return $this->infoLink;
    }

    /**
     * @param string $infoLink
     * @return VolumeInfo
     */
    public function setInfoLink(string $infoLink): VolumeInfo
    {
        $this->infoLink = $infoLink;
        return $this;
    }

    /**
     * @return string
     */
    public function getCanonicalVolumeLink(): string
    {
        return $this->canonicalVolumeLink;
    }

    /**
     * @param string $canonicalVolumeLink
     * @return VolumeInfo
     */
    public function setCanonicalVolumeLink(string $canonicalVolumeLink): VolumeInfo
    {
        $this->canonicalVolumeLink = $canonicalVolumeLink;
        return $this;
    }




}