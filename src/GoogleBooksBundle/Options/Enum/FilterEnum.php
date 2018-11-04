<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 20:00
 */

namespace GoogleBooksBundle\Options\Enum;


use MyCLabs\Enum\Enum;
/**
 * Filter search results.
 * @package GoogleBooksBundle\Model\Options
 *
 * @method static FilterEnum EBOOKS()
 * @method static FilterEnum FULL()
 * @method static FilterEnum FREE_EBOOKS()
 * @method static FilterEnum PAID_EBOOKS()
 * @method static FilterEnum PARTIAL()
 */
class FilterEnum extends Enum
{
    /**
     * All Google eBooks.
     */
    private const EBOOKS = 'ebooks';
    /**
     * Google eBook with full volume text viewability.
     */
    private const FREE_EBOOKS = "free-ebooks";
    /**
     * Public can view entire volume text.
     */
    private const FULL = "full";
    /**
     * Google eBook with a price.
     */
    private const PAID_EBOOKS = "paid-ebooks";
    /**
     * Public able to see parts of text.
     */
    private const PARTIAL = "partial";
}