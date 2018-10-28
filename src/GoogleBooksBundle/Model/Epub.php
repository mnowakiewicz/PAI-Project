<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:57
 */

namespace BookBundle\Model;


/**
 * Class Epub
 * @package BookBundle\Model
 */
class Epub
{
    /**
     * @var boolean
     */
    private $isAvailable;

    /**
     * Epub constructor.
     */
    public function __construct()
    {
    }

    public static function create(array $epubData):Epub
    {
        $return = new Epub();

        $return
            ->setIsAvailable($epubData["isAvailable"]);

        return $return;
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    /**
     * @param bool $isAvailable
     * @return Epub
     */
    public function setIsAvailable(bool $isAvailable): Epub
    {
        $this->isAvailable = $isAvailable;
        return $this;
    }




}