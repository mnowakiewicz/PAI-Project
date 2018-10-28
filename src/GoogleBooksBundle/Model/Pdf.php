<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:58
 */

namespace GoogleBooksBundle\Model;


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
     * @param array $pdfData
     * @return Pdf
     */
    public static function create(array $pdfData): Pdf
    {
        $return = new Pdf();

        $return
            ->setIsAvailable($pdfData["isAvailable"]);

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
     * @return Pdf
     */
    public function setIsAvailable(bool $isAvailable): Pdf
    {
        $this->isAvailable = $isAvailable;
        return $this;
    }


}