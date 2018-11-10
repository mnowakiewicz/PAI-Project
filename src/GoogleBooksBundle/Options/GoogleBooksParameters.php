<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 20:20
 */

namespace GoogleBooksBundle\Options;


use GoogleBooksBundle\Options\Enum\FilterEnum;
use GoogleBooksBundle\Options\Enum\LibraryRestrictEnum;
use GoogleBooksBundle\Options\Enum\OrderByEnum;
use GoogleBooksBundle\Options\Enum\PrintTypeEnum;
use GoogleBooksBundle\Options\Enum\ProjectionEnum;

/**
 * Class GoogleBooksAPIRequestParameters
 * @package GoogleBooksBundle\Options
 */
class GoogleBooksParameters
{
    /**
     * @var string
     */
    private $q;
    /**
     * @var string|null
     */
    private $filter;
    /**
     * @var string|null
     */
    private $langRestrict;
    /**
     * @var string|null
     */
    private $libraryRestrict;
    /**
     * @var integer|null
     */
    private $maxResults;
    /**
     * @var string|null
     */
    private $orderBy;
    /**
     * @var string|null
     */
    private $partner;
    /**
     * @var string|null
     */
    private $printType;
    /**
     * @var string|null
     */
    private $projection;
    /**
     * @var boolean|null
     */
    private $showPreorders;
    /**
     * @var string|null
     */
    private $source;
    /**
     * @var integer|null
     */
    private $startIndex;

    /**
     * GoogleBooksAPIRequestParameters constructor.
     * @param string $q
     */
    public function __construct(string $q)
    {
        $this->q = $q;
    }

    /**
     * @return string
     */
    public function getQ(): string
    {
        return $this->q;
    }

    /**
     * @param string $q
     * @return GoogleBooksParameters
     */
    public function setQ(string $q): GoogleBooksParameters
    {
        $this->q = $q;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFilter(): ?string
    {
        return $this->filter;
    }

    /**
     * @param FilterEnum $filterEnum
     * @return GoogleBooksParameters
     */
    public function setFilter(FilterEnum $filterEnum): GoogleBooksParameters
    {
        $this->filter = $filterEnum->getValue();
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLangRestrict(): ?string
    {
        return $this->langRestrict;
    }

    /**
     * @param string $langRestrict
     * @return GoogleBooksParameters
     */
    public function setLangRestrict(string $langRestrict): GoogleBooksParameters
    {
        $this->langRestrict = $langRestrict;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLibraryRestrict(): ?string
    {
        return $this->libraryRestrict;
    }

    /**
     * @param LibraryRestrictEnum $enum
     * @return GoogleBooksParameters
     */
    public function setLibraryRestrict(LibraryRestrictEnum $enum): GoogleBooksParameters
    {
        $this->libraryRestrict = $enum->getValue();
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxResults(): ?int
    {
        return $this->maxResults;
    }

    /**
     * @param null $maxResults
     * @return GoogleBooksParameters
     */
    public function setMaxResults(int $maxResults): GoogleBooksParameters
    {
        $this->maxResults = $maxResults;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @param OrderByEnum $enum
     * @return GoogleBooksParameters
     */
    public function setOrderBy(OrderByEnum $enum): GoogleBooksParameters
    {
        $this->orderBy = $enum->getValue();
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPartner(): ?string
    {
        return $this->partner;
    }

    /**
     * @param string $partner
     * @return GoogleBooksParameters
     */
    public function setPartner(string $partner): GoogleBooksParameters
    {
        $this->partner = $partner;
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
     * @param PrintTypeEnum $enum
     * @return GoogleBooksParameters
     */
    public function setPrintType(PrintTypeEnum $enum): GoogleBooksParameters
    {
        $this->printType = $enum->getValue();
        return $this;
    }

    /**
     * @return null|string
     */
    public function getProjection(): ?string
    {
        return $this->projection;
    }

    /**
     * @param ProjectionEnum $projectionEnum
     * @return GoogleBooksParameters
     */
    public function setProjection(ProjectionEnum $projectionEnum): GoogleBooksParameters
    {
        $this->projection = $projectionEnum->getValue();
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShowPreorders(): ?bool
    {
        return $this->showPreorders;
    }

    /**
     * @param bool $showPreorders
     * @return GoogleBooksParameters
     */
    public function setShowPreorders(bool $showPreorders): GoogleBooksParameters
    {
        $this->showPreorders = $showPreorders;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return GoogleBooksParameters
     */
    public function setSource(string $source): GoogleBooksParameters
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStartIndex(): ?int
    {
        return $this->startIndex;
    }

    /**
     * @param int $startIndex
     * @return GoogleBooksParameters
     */
    public function setStartIndex(int $startIndex): GoogleBooksParameters
    {
        $this->startIndex = $startIndex;
        return $this;
    }



}