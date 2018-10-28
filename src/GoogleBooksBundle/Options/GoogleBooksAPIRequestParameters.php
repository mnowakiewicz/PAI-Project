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
     * @param string $filter
     * @return GoogleBooksAPIRequestParameters
     */
    public function setFilter(string $filter): GoogleBooksAPIRequestParameters
    {
        $this->filter = $filter;
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
     * @return GoogleBooksAPIRequestParameters
     */
    public function setLangRestrict(string $langRestrict): GoogleBooksAPIRequestParameters
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
     * @param string $orderBy
     * @return GoogleBooksAPIRequestParameters
     */
    public function setOrderBy(string $orderBy): GoogleBooksAPIRequestParameters
    {
        $this->orderBy = $orderBy;
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
     * @param string $printType
     * @return GoogleBooksAPIRequestParameters
     */
    public function setPrintType(string $printType): GoogleBooksAPIRequestParameters
    {
        $this->printType = $printType;
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
     * @param string $projection
     * @return GoogleBooksAPIRequestParameters
     */
    public function setProjection(string $projection): GoogleBooksAPIRequestParameters
    {
        $this->projection = $projection;
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





    public function parametersToString(): string
    {
        $string = '';
        try {
            $reflect = new \ReflectionClass(self::class);
            $props = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);
        } catch (\ReflectionException $e) {
        }

        if (count($props)) {
            for ($i = 0; $i < count($props); $i++) {
                $functionName = 'get' . ucfirst($props[$i]->getName());
                if (call_user_func_array([$this, $functionName], []) != null) {
                    $string .= $props[$i]->getName() . '=' . call_user_func_array([$this, $functionName], []) . '&';
                }
            }
        }
        $string = substr($string, 0, -1);
        return $string;
    }

}