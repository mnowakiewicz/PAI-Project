<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 20:17
 */

namespace GoogleBooksBundle\Options;


use MyCLabs\Enum\Enum;

/**
 * Class ProjectionEnum
 * @package GoogleBooksBundle\Options
 *
 * @method static ProjectionEnum FULL()
 * @method static ProjectionEnum LITE()
 */
class ProjectionEnum extends Enum
{
    private const FULL = 'full';
    private const LITE = 'lite';
}