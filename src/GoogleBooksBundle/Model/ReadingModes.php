<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:50
 */

namespace GoogleBooksBundle\Model;


/**
 * Class ReadingMode
 * @package BookBundle\Model
 */
class ReadingModes
{

    /**
     * @var boolean
     */
    private $text;
    /**
     * @var boolean
     */
    private $image;

    /**
     * ReadingMode constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param array $readingModesData
     * @return ReadingModes
     */
    public static function create(array $readingModesData): ReadingModes
    {
        $return = new ReadingModes();

        $return
            ->setImage($readingModesData['image'])
            ->setText($readingModesData['text']);

        return $return;
    }

    /**
     * @return bool
     */
    public function isText(): bool
    {
        return $this->text;
    }

    /**
     * @param bool $text
     * @return ReadingModes
     */
    public function setText(bool $text): ReadingModes
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return bool
     */
    public function isImage(): bool
    {
        return $this->image;
    }

    /**
     * @param bool $image
     * @return ReadingModes
     */
    public function setImage(bool $image): ReadingModes
    {
        $this->image = $image;
        return $this;
    }


}