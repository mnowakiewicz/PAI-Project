<?php

namespace WebSocketBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use OperatorBundle\Entity\Operator;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="WebSocketBundle\Repository\MessageRepository")
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var \DateTime|null
     * @ORM\Column(name="creationDate", nullable=false, unique=false, type="datetime")
     */
    private $creationDate;

    /**
     * @var Operator|null
     *
     * @ORM\ManyToOne(targetEntity="OperatorBundle\Entity\Operator", inversedBy="messages")
     */
    private $from;

    /**
     * @var Operator|null
     *
     * @ORM\ManyToOne(targetEntity="OperatorBundle\Entity\Operator", inversedBy="messages")
     */
    private $to;

    /**
     * Message constructor.
     * @param string|null $text
     * @param \DateTime|null $creationDate
     * @param Operator|null $from
     * @param Operator|null $to
     */
    public function __construct(?string $text, ?\DateTime $creationDate, ?Operator $from, ?Operator $to)
    {
        $this->text = $text;
        $this->creationDate = $creationDate;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return int
     */


    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Message
     */
    public function setId(int $id): Message
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return Message
     */
    public function setText(?string $text): Message
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime|null $creationDate
     * @return Message
     */
    public function setCreationDate(?\DateTime $creationDate): Message
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return Operator|null
     */
    public function getFrom(): ?Operator
    {
        return $this->from;
    }

    /**
     * @param Operator|null $from
     * @return Message
     */
    public function setFrom(?Operator $from): Message
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return Operator|null
     */
    public function getTo(): ?Operator
    {
        return $this->to;
    }

    /**
     * @param Operator|null $to
     * @return Message
     */
    public function setTo(?Operator $to): Message
    {
        $this->to = $to;
        return $this;
    }

}

