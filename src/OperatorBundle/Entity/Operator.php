<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 21.10.18
 * Time: 20:03
 */

namespace OperatorBundle\Entity;

use BookBundle\Entity\Book;
use CommonBundle\Common\CommonEntityMethodsInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var \DateTime|null
     * @ORM\Column(name="editDate", nullable=true, unique=false, type="datetime")
     */
    protected $editDate;

    /**
     * @var string|null
     * @ORM\Column(type="string", unique=false, nullable=true, length=255)
     */
    protected $name;

    /**
     * @var string|null
     * @ORM\Column(type="string", unique=false, nullable=true, length=255, name="lastName")
     */
    protected $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar", nullable=true, unique=false, type="blob")
     */
    protected $avatar;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="BookBundle\Entity\Book", mappedBy="creator")
     */
    protected $booksCreated;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="WebSocketBundle\Entity\Message", mappedBy="operators")
     */
    protected $messages;

    /**
     * Date/Time of the last activity
     *
     * @var \Datetime|null
     * @ORM\Column(type="datetime", nullable=true, unique=false)
     */
    protected $lastActivityAt;

    /**
     * @var boolean|null
     *
     * @ORM\Column(type="boolean", nullable=true, unique=false)
     */
    protected $isActiveNow;

    /**
     * Operator constructor.
     * @param bool $isActive
     * @throws \Exception
     */
    public function __construct($isActive = true)
    {
        parent::__construct();
        $this->creationDate = new \DateTime('now');
        $this->lastActivityAt = new \DateTime('now');
        $this->isActiveNow = false;
        $this->isActive = $isActive;
        $this->booksCreated = new ArrayCollection();
    }

    /**
     * @param Book $book
     * @return Operator
     */
    public function addBook(Book $book):self
    {
        $this->booksCreated->add($book);
        return $this;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return \DateTime|null
     */
    public function getEditDate(): ?\DateTime
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

    /**
     * @return null|string
     */
    public function getName(): ?string
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
     * @return null|string
     */
    public function getLastName(): ?string
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

    /**
     * @return bool
     */
    public function getIsActive(): bool
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
     * @return null|string
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param null|string $avatar
     * @return Operator
     */
    public function setAvatar(string $avatar): Operator
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getBooksCreated(): ArrayCollection
    {
        return $this->booksCreated;
    }

    /**
     * @param ArrayCollection $booksCreated
     * @return Operator
     */
    public function setBooksCreated(ArrayCollection $booksCreated): Operator
    {
        $this->booksCreated = $booksCreated;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    /**
     * @param Collection $messages
     * @return Operator
     */
    public function setMessages(Collection $messages): Operator
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * @return \Datetime|null
     */
    public function getLastActivityAt(): ?\Datetime
    {
        return $this->lastActivityAt;
    }

    /**
     * @param \Datetime|null $lastActivityAt
     * @return Operator
     */
    public function setLastActivityAt(?\Datetime $lastActivityAt): Operator
    {
        $this->lastActivityAt = $lastActivityAt;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isActiveNow(): ?bool
    {
        return $this->isActiveNow;
    }

    /**
     * @param bool|null $isActiveNow
     * @return Operator
     */
    public function setIsActiveNow(?bool $isActiveNow): Operator
    {
        $this->isActiveNow = $isActiveNow;
        return $this;
    }
}