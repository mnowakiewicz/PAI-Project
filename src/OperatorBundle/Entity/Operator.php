<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 21.10.18
 * Time: 20:03
 */

namespace OperatorBundle\Entity;

use CommonBundle\Entity\CommonEntityMethodsInterface;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * Class Operator
 * @package OperatorBundle\Entity
 * @ORM\Entity(repositoryClass="OperatorBundle\Repository\OperatorRepository")
 * @ORM\Table(name="operator")
 */
class Operator extends BaseUser implements CommonEntityMethodsInterface
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
     * @var string
     * @ORM\Column(type="string", unique=false, nullable=true, length=255)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", unique=false, nullable=true, length=255, name="lastName")
     */
    protected $lastName;

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
     * @return Operator
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
     * @return Operator
     */
    public function setEditDate(\DateTime $editDate): CommonEntityMethodsInterface
    {
        $this->editDate = $editDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Operator
     */
    public function setName(string $name): Operator
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Operator
     */
    public function setLastName(string $lastName): Operator
    {
        $this->lastName = $lastName;
        return $this;
    }




}