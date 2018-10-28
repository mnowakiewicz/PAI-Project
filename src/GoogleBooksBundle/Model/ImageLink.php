<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:52
 */

namespace BookBundle\Model;


/**
 * Class ImageLink
 * @package BookBundle\Model
 */
class ImageLink
{
    /**
     * @var string
     */
    private $smallThumbnail;
    /**
     * @var string
     */
    private $thumbnail;

    /**
     * ImageLink constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getSmallThumbnail(): string
    {
        return $this->smallThumbnail;
    }

    /**
     * @param string $smallThumbnail
     * @return ImageLink
     */
    public function setSmallThumbnail(string $smallThumbnail): ImageLink
    {
        $this->smallThumbnail = $smallThumbnail;
        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     * @return ImageLink
     */
    public function setThumbnail(string $thumbnail): ImageLink
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }



}