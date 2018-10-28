<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:50
 */

namespace BookBundle\Model;


/**
 * Class ReadingMode
 * @package BookBundle\Model
 */
class ReadingMode
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
     * @return bool
     */
    public function isText(): bool
    {
        return $this->text;
    }

    /**
     * @param bool $text
     * @return ReadingMode
     */
    public function setText(bool $text): ReadingMode
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
     * @return ReadingMode
     */
    public function setImage(bool $image): ReadingMode
    {
        $this->image = $image;
        return $this;
    }


}