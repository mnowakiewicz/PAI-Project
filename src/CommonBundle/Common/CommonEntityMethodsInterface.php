<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 27.10.18
 * Time: 12:38
 */

namespace CommonBundle\Common;


/**
 * Interface CommonEntityMethodsInterface
 * @package CommonBundle\Entity
 */
interface CommonEntityMethodsInterface
{
    /**
     * @return int
     */
    public function getId(): ?int;

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @param bool $isActive
     * @return CommonEntityMethodsInterface
     */
    public function setIsActive(bool $isActive): CommonEntityMethodsInterface;

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime;

    /**
     * @param \DateTime $creationDate
     * @return CommonEntityMethodsInterface
     */
    public function setCreationDate(\DateTime $creationDate): CommonEntityMethodsInterface;

    /**
     * @return \DateTime
     */
    public function getEditDate(): ?\DateTime;

    /**
     * @param \DateTime $editDate
     * @return CommonEntityMethodsInterface
     */
    public function setEditDate(\DateTime $editDate): CommonEntityMethodsInterface;
}