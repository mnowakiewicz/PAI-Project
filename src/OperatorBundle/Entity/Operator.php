<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 21.10.18
 * Time: 20:03
 */

namespace OperatorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * Class Operator
 * @package OperatorBundle\Entity
 * @ORM\Entity(repositoryClass="OperatorBundle\Repository\OperatorRepository")
 * @ORM\Table(name="operator")
 */
class Operator extends BaseUser
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
        parent::__construct();
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
     * @return Operator
     */
    public function setIsActive(bool $isActive): Operator
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
     * @return Operator
     */
    public function setCreationDate(\DateTime $creationDate): Operator
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
     * @return Operator
     */
    public function setEditDate(\DateTime $editDate): Operator
    {
        $this->editDate = $editDate;
        return $this;
    }



}