<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 27.10.18
 * Time: 12:53
 */

namespace CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class CommonSuperClass
 * @package CommonBundle\Entity
 *
 * @ORM\MappedSuperclass()
 */
abstract class CommonSuperClass implements CommonEntityMethodsInterface
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     * @ORM\Column(name="isActive", nullable=false, type="boolean", unique=false)
     */
    protected $isActive;
    /**
     * @var \DateTime
     * @ORM\Column(name="creationDate", nullable=false, unique=false, type="datetime")
     */
    protected $creationDate;
    /**
     * @var \DateTime
     * @ORM\Column(name="editDate", nullable=true, unique=false, type="datetime")
     */
    protected $editDate;

    /**
     * Operator constructor.
     * @param bool $isActive
     */
    public function __construct($isActive = true)
    {
        $this->creationDate = new \DateTime('now');
        $this->isActive = $isActive;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return CommonSuperClass
     */
    public function setIsActive(bool $isActive): CommonEntityMethodsInterface
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return CommonSuperClass
     */
    public function setCreationDate(\DateTime $creationDate): CommonEntityMethodsInterface
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEditDate(): \DateTime
    {
        return $this->editDate;
    }

    /**
     * @param \DateTime $editDate
     * @return CommonEntityMethodsInterface
     */
    public function setEditDate(\DateTime $editDate): CommonEntityMethodsInterface
    {
        $this->editDate = $editDate;
        return $this;
    }
}