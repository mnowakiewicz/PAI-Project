<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 12:04
 */

namespace BookBundle\Model;


/**
 * Class SearchInfo
 * @package BookBundle\Model
 */
class SearchInfo
{
    /**
     * @var string
     */
    private $textSnippet;

    /**
     * SearchInfo constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getTextSnippet(): string
    {
        return $this->textSnippet;
    }

    /**
     * @param string $textSnippet
     * @return SearchInfo
     */
    public function setTextSnippet(string $textSnippet): SearchInfo
    {
        $this->textSnippet = $textSnippet;
        return $this;
    }


}