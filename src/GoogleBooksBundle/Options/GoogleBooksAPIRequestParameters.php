<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 20:20
 */

namespace GoogleBooksBundle\Options;


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
     * @var string
     */
    private $filter;
    /**
     * @var string
     */
    private $langRestrict;
    /**
     * @var string
     */
    private $libraryRestrict;
    /**
     * @var integer
     */
    private $maxResults;
    /**
     * @var string
     */
    private $orderBy;
    /**
     * @var string
     */
    private $partner;
    /**
     * @var string
     */
    private $printType;
    /**
     * @var string
     */
    private $projection;
    /**
     * @var boolean
     */
    private $showPreorders;
    /**
     * @var string
     */
    private $source;
    /**
     * @var integer
     */
    private $startIndex;

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
     * @return string
     */
    public function getFilter(): string
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
     * @return string
     */
    public function getLangRestrict(): string
    {
        return $this->langRestrict;
    }

    /**
     * @param string $langRestrict
     * @return GoogleBooksAPIRequestParameters
     */
    public function setLangRestrict(string $langRestrict): GoogleBooksAPIRequestParameters
    {
        $this->langRestrict = $langRestrict;
        return $this;
    }

    /**
     * @return string
     */
    public function getLibraryRestrict(): string
    {
        return $this->libraryRestrict;
    }


    /**
     * @param LibraryRestrictEnum $libraryRestrictEnum
     * @return GoogleBooksAPIRequestParameters
     */
    public function setLibraryRestrict(LibraryRestrictEnum $libraryRestrictEnum): GoogleBooksAPIRequestParameters
    {
        $this->libraryRestrict = $libraryRestrictEnum->getValue();
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxResults(): int
    {
        return $this->maxResults;
    }

    /**
     * @param int $maxResults
     * @return GoogleBooksAPIRequestParameters
     */
    public function setMaxResults(int $maxResults): GoogleBooksAPIRequestParameters
    {
        $this->maxResults = $maxResults;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }


    /**
     * @param OrderByEnum $orderByEnum
     * @return GoogleBooksAPIRequestParameters
     */
    public function setOrderBy(OrderByEnum $orderByEnum): GoogleBooksAPIRequestParameters
    {
        $this->orderBy = $orderByEnum->getValue();
        return $this;
    }

    /**
     * @return string
     */
    public function getPartner(): string
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
     * @return string
     */
    public function getPrintType(): string
    {
        return $this->printType;
    }


    /**
     * @param PrintTypeEnum $printTypeEnum
     * @return GoogleBooksAPIRequestParameters
     */
    public function setPrintType(PrintTypeEnum $printTypeEnum): GoogleBooksAPIRequestParameters
    {
        $this->printType = $printTypeEnum->getValue();
        return $this;
    }

    /**
     * @return string
     */
    public function getProjection(): string
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
     * @return bool
     */
    public function isShowPreorders(): bool
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
     * @return string
     */
    public function getSource(): string
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
     * @return int
     */
    public function getStartIndex(): int
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