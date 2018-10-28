<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:54
 */

namespace BookBundle\Model;


/**
 * Class SaleInfo
 * @package BookBundle\Model
 */
class SaleInfo
{
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $saleability;
    /**
     * @var boolean
     */
    private $isEbook;

    /**
     * SaleInfo constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return SaleInfo
     */
    public function setCountry(string $country): SaleInfo
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaleability(): string
    {
        return $this->saleability;
    }

    /**
     * @param string $saleability
     * @return SaleInfo
     */
    public function setSaleability(string $saleability): SaleInfo
    {
        $this->saleability = $saleability;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEbook(): bool
    {
        return $this->isEbook;
    }

    /**
     * @param bool $isEbook
     * @return SaleInfo
     */
    public function setIsEbook(bool $isEbook): SaleInfo
    {
        $this->isEbook = $isEbook;
        return $this;
    }

}