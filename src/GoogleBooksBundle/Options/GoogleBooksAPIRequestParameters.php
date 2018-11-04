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
class GoogleBooksAPIRequestParameters
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setQ(string $q): GoogleBooksAPIRequestParameters
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setFilter(FilterEnum $filterEnum): GoogleBooksAPIRequestParameters
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
     * @param LibraryRestrictEnum $enum
     * @return GoogleBooksAPIRequestParameters
     */
    public function setLangRestrict(LibraryRestrictEnum $enum): GoogleBooksAPIRequestParameters
    {
        $this->langRestrict = $enum->getValue();
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
     * @param string $libraryRestrict
     * @return GoogleBooksAPIRequestParameters
     */
    public function setLibraryRestrict(string $libraryRestrict): GoogleBooksAPIRequestParameters
    {
        $this->libraryRestrict = $libraryRestrict;
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setMaxResults(int $maxResults): GoogleBooksAPIRequestParameters
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setOrderBy(OrderByEnum $enum): GoogleBooksAPIRequestParameters
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setPartner(string $partner): GoogleBooksAPIRequestParameters
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setPrintType(PrintTypeEnum $enum): GoogleBooksAPIRequestParameters
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setProjection(ProjectionEnum $projectionEnum): GoogleBooksAPIRequestParameters
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setShowPreorders(bool $showPreorders): GoogleBooksAPIRequestParameters
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setSource(string $source): GoogleBooksAPIRequestParameters
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setStartIndex(int $startIndex): GoogleBooksAPIRequestParameters
    {
        $this->startIndex = $startIndex;
        return $this;
    }

}