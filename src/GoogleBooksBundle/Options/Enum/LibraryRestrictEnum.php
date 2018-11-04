<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 20:07
 */

namespace GoogleBooksBundle\Options\Enum;


use MyCLabs\Enum\Enum;

/**
 * Class LibraryRestrictEnum
 * @package GoogleBooksBundle\Options
 *
 * @method static LibraryRestrictEnum MY_LIBRARY()
 * @method static LibraryRestrictEnum NO_RESTRICT()
 */
class LibraryRestrictEnum extends Enum
{

    private const MY_LIBRARY = "my-library";
    private const NO_RESTRICT = "no-restrict";

}