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
class ImageLinks
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

    public static function create(array $imageLinksData):ImageLinks
    {
        $return = new ImageLinks();

        $return
            ->setSmallThumbnail($imageLinksData["smallThumbnail"])
            ->setThumbnail("thumbnail");

        return $return;
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
     * @return ImageLinks
     */
    public function setSmallThumbnail(string $smallThumbnail): ImageLinks
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
     * @return ImageLinks
     */
    public function setThumbnail(string $thumbnail): ImageLinks
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }



}