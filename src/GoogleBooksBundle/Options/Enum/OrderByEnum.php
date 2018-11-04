<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 20:11
 */

namespace GoogleBooksBundle\Options\Enum;


use MyCLabs\Enum\Enum;

/**
 * Class OrderByEnum
 * @package GoogleBooksBundle\Options
 *
 * @method static OrderByEnum NEWEST()
 * @method static OrderByEnum RELEVANCE()
 */
class OrderByEnum extends Enum
{
    private const NEWEST = 'newest';
    private const RELEVANCE = 'relevance';

}