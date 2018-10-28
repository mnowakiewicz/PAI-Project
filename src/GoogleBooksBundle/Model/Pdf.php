<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:58
 */

namespace BookBundle\Model;


/**
 * Class Pdf
 * @package BookBundle\Model
 */
class Pdf
{
    /**
     * @var boolean
     */
    private $isAvailable;

    /**
     * Pdf constructor.
     */
    public function __construct()
    {
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
     * @return Pdf
     */
    public function setIsAvailable(bool $isAvailable): Pdf
    {
        $this->isAvailable = $isAvailable;
        return $this;
    }




}