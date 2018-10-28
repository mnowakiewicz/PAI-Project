<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 20:13
 */

namespace GoogleBooksBundle\Options;


use MyCLabs\Enum\Enum;

/**
 * Class PrintTypeEnum
 * @package GoogleBooksBundle\Options
 *
 * @method static PrintTypeEnum ALL()
 * @method static PrintTypeEnum BOOKS()
 * @method static PrintTypeEnum MAGAZINES()
 */
class PrintTypeEnum extends Enum
{
    private const ALL = 'all';
    private const BOOKS = 'books';
    private const MAGAZINES = 'magazines';
}