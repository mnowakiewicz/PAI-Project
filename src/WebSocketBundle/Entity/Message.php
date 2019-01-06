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
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var \DateTime
     * @ORM\Column(name="creationDate", nullable=false, unique=false, type="datetime")
     */
    private $creationDate;

    /**
     * @var Operator
     *
     * @ORM\ManyToOne(targetEntity="OperatorBundle\Entity\Operator", inversedBy="messages")
     */
    private $from;

    /**
     * @var Operator
     *
     * @ORM\ManyToOne(targetEntity="OperatorBundle\Entity\Operator")
     */
    private $to;

    /**
     * Message constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Message
     */
    public function setText($text): Message
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
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
     * @return Message
     */
    public function setCreationDate(\DateTime $creationDate): Message
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return Operator
     */
    public function getFrom(): Operator
    {
        return $this->from;
    }

    /**
     * @param Operator $from
     * @return Message
     */
    public function setFrom(Operator $from): Message
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return Operator
     */
    public function getTo(): Operator
    {
        return $this->to;
    }

    /**
     * @param Operator $to
     * @return Message
     */
    public function setTo(Operator $to): Message
    {
        $this->to = $to;
        return $this;
    }

}

