<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 08.11.18
 * Time: 17:51
 */

namespace BookBundle\Entity\Enum;


use MyCLabs\Enum\Enum;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class StatusEnum
 * @package BookBundle\Entity\Enum
 *
 * @method static StatusEnum PUBLISHED()
 * @method static StatusEnum DRAFT()
 */
class StatusEnum extends Enum
{
    /**
     *
     */
    private const PUBLISHED = 'published';
    /**
     *
     */
    private const DRAFT = 'draft';
}