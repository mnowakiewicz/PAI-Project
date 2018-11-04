<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:52
 */

namespace GoogleBooksBundle\Model;


/**
 * Class ImageLink
 * @package BookBundle\Model
 */
class ImageLinks
{
    /**
     * @var string|null
     */
    private $smallThumbnail;
    /**
     * @var string|null
     */
    private $thumbnail;

    /**
     * ImageLink constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param array $imageLinksData
     * @return ImageLinks
     */
    public static function create(array $imageLinksData): ImageLinks
    {
        $return = new ImageLinks();

        $return
            ->setSmallThumbnail($imageLinksData["smallThumbnail"])
            ->setThumbnail("thumbnail");

        return $return;
    }

    /**
     * @return null|string
     */
    public function getSmallThumbnail(): ?string
    {
        return $this->smallThumbnail;
    }

    /**
     * @param null|string $smallThumbnail
     * @return ImageLinks
     */
    public function setSmallThumbnail(?string $smallThumbnail): ImageLinks
    {
        $this->smallThumbnail = $smallThumbnail;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @param null|string $thumbnail
     * @return ImageLinks
     */
    public function setThumbnail(?string $thumbnail): ImageLinks
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }



}