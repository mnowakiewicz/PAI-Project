<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:47
 */

namespace BookBundle\Model;


/**
 * Class Item
 * @package BookBundle\Model
 */
class Item
{
    /**
     * @var string
     */
    private $kind;
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $etag;
    /**
     * @var string
     */
    private $selfLink;
    /**
     * @var VolumeInfo
     */
    private $volumeInfo;
    /**
     * @var SaleInfo
     */
    private $saleInfo;
    /**
     * @var AccessInfo
     */
    private $accessInfo;
    /**
     * @var SaleInfo
     */
    private $searchInfo;

    /**
     * Item constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @param string $kind
     * @return Item
     */
    public function setKind(string $kind): Item
    {
        $this->kind = $kind;
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Item
     */
    public function setId(string $id): Item
    {
        $this->id = $id;
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
     * @return Item
     */
    public function setEtag(string $etag): Item
    {
        $this->etag = $etag;
        return $this;
    }

    /**
     * @return string
     */
    public function getSelfLink(): string
    {
        return $this->selfLink;
    }

    /**
     * @param string $selfLink
     * @return Item
     */
    public function setSelfLink(string $selfLink): Item
    {
        $this->selfLink = $selfLink;
        return $this;
    }

    /**
     * @return VolumeInfo
     */
    public function getVolumeInfo(): VolumeInfo
    {
        return $this->volumeInfo;
    }

    /**
     * @param VolumeInfo $volumeInfo
     * @return Item
     */
    public function setVolumeInfo(VolumeInfo $volumeInfo): Item
    {
        $this->volumeInfo = $volumeInfo;
        return $this;
    }

    /**
     * @return SaleInfo
     */
    public function getSaleInfo(): SaleInfo
    {
        return $this->saleInfo;
    }

    /**
     * @param SaleInfo $saleInfo
     * @return Item
     */
    public function setSaleInfo(SaleInfo $saleInfo): Item
    {
        $this->saleInfo = $saleInfo;
        return $this;
    }

    /**
     * @return AccessInfo
     */
    public function getAccessInfo(): AccessInfo
    {
        return $this->accessInfo;
    }

    /**
     * @param AccessInfo $accessInfo
     * @return Item
     */
    public function setAccessInfo(AccessInfo $accessInfo): Item
    {
        $this->accessInfo = $accessInfo;
        return $this;
    }

    /**
     * @return SaleInfo
     */
    public function getSearchInfo(): SaleInfo
    {
        return $this->searchInfo;
    }

    /**
     * @param SaleInfo $searchInfo
     * @return Item
     */
    public function setSearchInfo(SaleInfo $searchInfo): Item
    {
        $this->searchInfo = $searchInfo;
        return $this;
    }

}